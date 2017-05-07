<?php

namespace limenet\GitVersion\Formatters;

use Spatie\Regex\Regex;

abstract class AbstractFormatter implements FormatterInterface
{
    protected $data;
    protected $format;

    public function __construct(?string $format = null)
    {
        if ($format) {
            $this->setFormat($format);
        }
    }

    public function setFormat(string $format)
    {
        $this->format = $format;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function __toString() : string
    {
        return $this->formatAsString();
    }

    public function format() : string
    {
        return (string) $this;
    }

    protected function formatAsString()
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
            $this->format
        )->result();
    }
}
