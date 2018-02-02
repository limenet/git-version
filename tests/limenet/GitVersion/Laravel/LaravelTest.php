<?php

namespace limenet\GitVersion\Laravel;

use Orchestra\Testbench\TestCase;

class LaravelTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'GitVersion' => Facade::class,
        ];
    }

    public function testIsBound()
    {
        $this->assertArrayHasKey(ServiceProvider::class, app()->getLoadedProviders());
    }

    public function testFacade()
    {
        $this->assertNotEmpty(GitVersion::get());
    }
}
