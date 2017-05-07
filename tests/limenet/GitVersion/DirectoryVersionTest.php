<?php

namespace limenet\GitVersion;

use Composer\Semver\VersionParser;
use InvalidArgumentException;
use limenet\GitVersion\Formatters\CustomFormatter;
use limenet\GitVersion\Formatters\SemverFormatter;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DirectoryVersionTest extends TestCase
{
    public function testSemver() : void
    {
        $dir = Helpers::clone('https://github.com/composer/composer');

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
