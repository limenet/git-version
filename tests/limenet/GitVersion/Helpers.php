<?php

namespace limenet\GitVersion;

use Ramsey\Uuid\Uuid;
use limenet\GitVersion\Formatters\SemverFormatter;
use limenet\GitVersion\Formatters\CustomFormatter;
use Composer\Semver\VersionParser;

class Helpers
{
    public static function clone($repo)
    {
        $dir = Uuid::uuid4()->toString();

        $descriptorspec = [
           0 => ['pipe', 'r'],  // stdin
           1 => ['pipe', 'w'],  // stdout
           2 => ['pipe', 'w'],  // stderr
        ];

        $process = proc_open('git clone '.$repo.' '.$dir, $descriptorspec, $pipes, sys_get_temp_dir());

        trim(stream_get_contents($pipes[2]));

        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        // It is important that you close any pipes before calling
        // proc_close in order to avoid a deadlock
        proc_close($process);

        return sys_get_temp_dir().'/'.$dir;
    }

    public static function assertSemver($obj, AbstractVersion $version)
    {
        $v = $version->get(new SemverFormatter());
        $obj->assertNotEmpty($v);
        $obj->assertNotEmpty($version->get(new CustomFormatter('{tag}')));
        $obj->assertNotEmpty($version->get(new CustomFormatter('{commit}')));

        $vv = (new VersionParser())->normalize($v);
        $obj->assertInternalType('string', $v);

    }
}
