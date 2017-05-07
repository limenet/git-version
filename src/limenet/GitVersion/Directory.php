<?php

namespace limenet\GitVersion;

use InvalidArgumentException;
use limenet\GitVersion\Formatters\FormatterInterface;
use RuntimeException;

class Directory extends AbstractVersion
{
    protected function resolve(?FormatterInterface $formatter = null)
    {
    }
}
