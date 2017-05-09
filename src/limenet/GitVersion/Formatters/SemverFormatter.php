<?php

namespace limenet\GitVersion\Formatters;

class SemverFormatter extends AbstractFormatter
{
    protected $format = '{tag}+{branch}-{commit_short}';

    public function __construct()
    {
    }
}
