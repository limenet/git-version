<?php

use PHPUnit\Framework\TestCase;
use limenet\GitVersion\GitHelper;
use Ramsey\Uuid\Uuid;
use limenet\GitVersion\Version;
use limenet\GitVersion\Formatters\SemverFormatter;

class VersionTest extends TestCase
{
    public function testSemver() : void
    {
        $dir = GitHelper::clone('https://github.com/composer/composer');

        $version = new Version($dir);
        $v = $version->get(new SemverFormatter());

        var_dump($v);
        $this->assertNotEmpty($v);
    }

    public function testMissingFormatter() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $dir = GitHelper::clone('https://github.com/composer/composer');

        $version = new Version($dir);
        $version->get();
    }

    public function testNonExistingPath() : void
    {
        $this->expectException(InvalidArgumentException::class);
        new Version('/some/random/path/'.Uuid::uuid4()->toString());
    }
}