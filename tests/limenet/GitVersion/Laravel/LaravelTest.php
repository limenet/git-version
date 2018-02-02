<?php

namespace limenet\GitVersion\Laravel;

use limenet\GitVersion\Formatters\SemverFormatter;
use limenet\GitVersion\Formatters\UrlFormatter;
use Orchestra\Testbench\TestCase;
use limenet\GitVersion\Laravel\Facade;
use limenet\GitVersion\Laravel\ServiceProvider;

class LaravelTest extends TestCase {

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
    protected function getPackageAliases($app)
    {
        return [
            'GitVersion' => Facade::class
        ];
    }
public function testIsBound()
    {
        $this->assertArrayHasKey(ServiceProvider::class, app()->getLoadedProviders());
    }

    public function testFacade(){
        $this->assertNotEmpty(GitVersion::get());
    }
}
