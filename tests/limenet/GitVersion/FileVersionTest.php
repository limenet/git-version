<?php

namespace limenet\GitVersion;

use limenet\GitVersion\Formatters\SemverFormatter;
use limenet\GitVersion\Formatters\UrlFormatter;
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

        $urlProps = [
            'scheme' => 'https',
            'host'   => 'limenet.ch',
            'port'   => 8443,
            'path'   => '/foo/bar',
            'query'  => 'baz=foobar',
        ];

        $url = $version->get(new UrlFormatter($urlProps));

        $this->assertSame($url, filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED | FILTER_FLAG_QUERY_REQUIRED));

        foreach ($urlProps as $key => $value) {
            $this->assertContains((string) $value, $url, 'URL property '.$key.' missing from the generated URL');
        }
    }

    public function testUrlContainsFilenameOnly() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/Auth.php', ['base' => 'https://limenet.ch']);

        $this->assertContains('Auth.php', $version->get(new UrlFormatter()));
        $this->assertNotContains('Facades', $version->get(new UrlFormatter()));
    }

    public function testUrlDoesNotContainPath() : void
    {
        $dir = Helpers::clone('https://github.com/illuminate/support');

        $version = new File($dir.'/Facades/Auth.php', ['base' => 'https://limenet.ch']);

        $this->assertNotContains(pathinfo($dir, PATHINFO_BASENAME), $version->get(new UrlFormatter()));
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
