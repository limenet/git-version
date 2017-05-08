<?php

namespace limenet\GitVersion;

use PHPUnit\Framework\TestCase;
use limenet\GitVersion\Formatters\CustomFormatter;
use limenet\GitVersion\Formatters\SemverFormatter;
use limenet\GitVersion\Formatters\UrlFormatter;

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

    public function testUrlFormattingSetBaseDifferently() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/App.php', ['base' => 'https://limenet.ch']);
        $this->assertNotContains('example.com', $version->get(new UrlFormatter()));
        $this->assertContains('github.com', $version->get(new UrlFormatter(['base' => 'https://github.com'])));
    }

    public function testUrlFormattingValidUrl() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/Auth.php');

        $url = $version->get(new UrlFormatter(
            [
                'scheme' => 'https',
                'host' => 'limenet.ch',
                'port' => 8443,
                'path' => '/foo/bar',
                'query' => 'foo=bar'
            ]
        ));
        $this->assertSame($url, filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED | FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED));
    }

    public function testUrlFormattingCustomVersion() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/Auth.php', ['base' => 'https://limenet.ch']);

        $this->assertContains('some-random-version', $version->get(new UrlFormatter(['version' => 'some-random-version'])));
    }

    public function testUrlFormattingSemverVersion() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/Auth.php', ['base' => 'https://limenet.ch']);
        $url = $version->get(new UrlFormatter(['version' => $version->get(new SemverFormatter())]));
        $this->assertContains($version->get(new SemverFormatter()), $url);
    }
}
