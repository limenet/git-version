<?php

namespace limenet\GitVersion;

use Spatie\Regex\Regex;
use Composer\Semver\VersionParser;
use limenet\GitVersion\Formatters\CustomFormatter;
use limenet\GitVersion\Formatters\SemverFormatter;
use Ramsey\Uuid\Uuid;

class Helpers
{
    private static $clones = [];

    public static function clone($repo)
    {
        if (!array_key_exists($repo, self::$clones)) {
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

            self::$clones[$repo] = sys_get_temp_dir().'/'.$dir;
        }

        return self::$clones[$repo];
    }

    public static function assertSemver($obj, AbstractVersion $version)
    {
        $v = $version->get(new SemverFormatter());

        $obj->assertNotEmpty($v);
        $obj->assertNotEmpty($version->get(new CustomFormatter('{tag}')));
        $obj->assertNotEmpty($version->get(new CustomFormatter('{commit}')));
        $obj->assertNotEmpty($version->get(new CustomFormatter('{commit_short}')));
        $obj->assertLessThan(strlen($version->get(new CustomFormatter('{commit}'))), strlen($version->get(new CustomFormatter('{commit_short}'))));

        $vv = (new VersionParser())->normalize($v);
        $obj->assertInternalType('string', $v);
    }
}
