<?php

namespace limenet\GitVersion\Formatters;

use Spatie\Regex\Regex;

abstract class AbstractFormatter implements FormatterInterface
{
    protected $data;
    protected $format;

    abstract public function __construct();

    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    public function setData(array $data)
    {
        $this->data = array_merge($data, $this->data ?? []);
    }

    public function setExtraData(array $data)
    {
        $this->data = array_merge($this->data ?? [], $data);
    }

    public function __toString() : string
    {
        return $this->formatAsString();
    }

    protected function formatAsString(?string $format = null)
    {
        return Regex::replace(
            [
                '{{tag}}',
                '{{branch}}',
                '{{commit}}',
            ],
            [
                $this->data['tag'],
                $this->data['branch'],
                $this->data['commit'],
            ],
            $format ?? $this->format
        )->result();
    }
}
