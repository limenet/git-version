<?php

namespace limenet\GitVersion\Formatters;

class SemverFormatter extends AbstractFormatter
{
    // tag+branch-commit

    protected $format = '{tag}+{branch}-{commit}';

    public function __toString() : string
    {
        return $this->formatAsString();
    }

    public function format() : string
    {
        return (string) $this;
    }
}
