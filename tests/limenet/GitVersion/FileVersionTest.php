<?php

namespace limenet\GitVersion;

use Composer\Semver\VersionParser;
use InvalidArgumentException;
use limenet\GitVersion\Formatters\CustomFormatter;
use limenet\GitVersion\Formatters\SemverFormatter;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class FileVersionTest extends TestCase
{
    public function testSemverFileRoot() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/composer.json');

        Helpers::assertSemver($this, $version);
    }

    public function testSemverFileInTree() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/App.php');

        Helpers::assertSemver($this, $version);
    }
}
