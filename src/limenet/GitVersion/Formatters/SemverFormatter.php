<?php

namespace limenet\GitVersion\Formatters;

class SemverFormatter extends AbstractFormatter
{
    protected $format = '{tag}+{branch}-{commit}';

    public function __construct()
    {
    }
}
