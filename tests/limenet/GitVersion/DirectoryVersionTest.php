<?php

namespace limenet\GitVersion;

use limenet\GitVersion\Formatters\CustomFormatter;
use PHPUnit\Framework\TestCase;

class DirectoryVersionTest extends TestCase
{
    public function testSemver() : void
    {
        $dir = Helpers::clone('https://github.com/composer/composer');

        $version = new Directory($dir);

        Helpers::assertSemver($this, $version);
    }

    public function testSemverValidBuildData() : void
    {
        $dir = Helpers::clone('https://github.com/limenet/just-in-time');

        $version = new Directory($dir);

        Helpers::assertSemver($this, $version);
    }

    public function testNoTags() : void
    {
        $dir = Helpers::clone('https://github.com/Roave/SecurityAdvisories');

        $version = new Directory($dir);
        $this->assertEmpty($version->get(new CustomFormatter('{tag}')));
        $this->assertNotEmpty($version->get(new CustomFormatter('{commit}')));
        $this->assertNotEmpty($version->get(new CustomFormatter('{branch}')));
    }
}
