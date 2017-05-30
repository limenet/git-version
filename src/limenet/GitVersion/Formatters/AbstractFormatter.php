<?php

namespace limenet\GitVersion\Formatters;

use Spatie\Regex\Regex;

abstract class AbstractFormatter implements FormatterInterface
{
    protected $data;
    protected $format;

    abstract public function __construct();

    public function setFormat(string $format) : void
    {
        $this->format = $format;
    }

    public function setData(array $data) : void
    {
        $this->data = array_merge($data, $this->data ?? []);
    }

    public function setExtraData(array $data) : void
    {
        $this->data = array_merge($this->data ?? [], $data);
    }

    public function __toString() : string
    {
        return $this->formatAsString();
    }

    protected function formatAsString(?string $format = null) : string
    {
        return Regex::replace(
            [
                '{{tag}}',
                '{{tag_semver}}',
                '{{branch}}',
                '{{commit}}',
                '{{commit_short}}',
            ],
            [
                $this->data['tag'],
                $this->data['tag_semver'],
                $this->data['branch'],
                $this->data['commit'],
                $this->data['commit_short'],
            ],
            $format ?? $this->format
        )->result();
    }
}
