<?php

namespace limenet\GitVersion\Formatters;

class CustomFormatter extends AbstractFormatter
{
    public function __construct(?string $format = null)
    {
        if ($format) {
            $this->setFormat($format);
        }
    }
}
