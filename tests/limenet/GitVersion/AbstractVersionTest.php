<?php

namespace limenet\GitVersion;

use Composer\Semver\VersionParser;
use InvalidArgumentException;
use limenet\GitVersion\Formatters\CustomFormatter;
use limenet\GitVersion\Formatters\SemverFormatter;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AbstractVersionTest extends TestCase
{
    public function testMissingFormatter() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $dir = Helpers::clone('https://github.com/composer/composer');

        $version = new Directory($dir);
        $version->get();
    }

    public function testNonExistingPath() : void
    {
        $this->expectException(InvalidArgumentException::class);
        $version = new Directory();
        $version->setTarget('/some/random/path/'.Uuid::uuid4()->toString());
    }
}
