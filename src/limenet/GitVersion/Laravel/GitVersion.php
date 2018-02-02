<?php

namespace limenet\GitVersion\Laravel;

use limenet\GitVersion\Directory;
use limenet\GitVersion\Formatters\SemverFormatter;

class GitVersion
{
    public static function get()
    {
        return (new Directory(base_path()))->get(new SemverFormatter());
    }
}
