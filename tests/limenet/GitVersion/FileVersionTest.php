<?php

namespace limenet\GitVersion;

use PHPUnit\Framework\TestCase;

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
