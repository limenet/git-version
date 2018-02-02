<?php

namespace limenet\GitVersion\Laravel;

use Illuminate\Support\ServiceProvider as BaseProvider;
use limenet\GitVersion\Directory;
use limenet\GitVersion\Formatters\SemverFormatter;

class ServiceProvider extends BaseProvider
{
    public function provides()
    {
        return [GitVersion::class];
    }

    public function register()
    {
        $this->app->singleton(GitVersion::class, function ($app) {
            return new GitVersion();
        });
    }
}
