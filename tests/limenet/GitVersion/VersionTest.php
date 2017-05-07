<?php
namespace limenet\GitVersion;

use PHPUnit\Framework\TestCase;
use limenet\GitVersion\GitHelper;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use limenet\GitVersion\Version;
use limenet\GitVersion\Formatters\SemverFormatter;
use Composer\Semver\VersionParser;

class VersionTest extends TestCase
{
    public function testSemver() : void
    {
        $dir = GitHelper::clone('https://github.com/composer/composer');

        $version = new Version($dir);
        $v = $version->get(new SemverFormatter());

        $this->assertNotEmpty($v);

        $vv = (new VersionParser())->normalize($v);
        $this->assertInternalType('string', $v);
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
        $version = new Version();
        $version->setPath('/some/random/path/'.Uuid::uuid4()->toString());
    }
}