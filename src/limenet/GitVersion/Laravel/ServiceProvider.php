<?php

namespace limenet\GitVersion\Laravel;

use Illuminate\Support\ServiceProvider as BaseProvider;
use limenet\GitVersion\Directory;
use limenet\GitVersion\Formatters\SemverFormatter;

class ServiceProvider extends BaseProvider
{
    public function provides()
    {
        return ['git-version'];
    }

    public static function get()
    {
        return (new Directory(base_path()))->get(new SemverFormatter());
    }
}
