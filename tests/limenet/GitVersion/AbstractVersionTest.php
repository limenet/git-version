<?php

namespace limenet\GitVersion;

use InvalidArgumentException;
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
