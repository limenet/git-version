<?php

namespace limenet\GitVersion\Formatters;

interface FormatterInterface {
    public function setData(array $data);

    public function format() : string;
}
