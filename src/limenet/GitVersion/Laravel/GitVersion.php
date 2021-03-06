<?php

namespace limenet\GitVersion\Laravel;

use Cache;
use limenet\GitVersion\Directory;
use limenet\GitVersion\Formatters\SemverFormatter;

class GitVersion
{
    public static function get()
    {
        return Cache::rememberForever('limenet.gitversion.get', function () {
            return (new Directory(base_path()))->get(new SemverFormatter());
        });
    }
}
