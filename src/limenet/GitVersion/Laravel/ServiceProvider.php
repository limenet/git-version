<?php

namespace limenet\GitVersion\Laravel;

use Illuminate\Support\ServiceProvider as BaseProvider;

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
