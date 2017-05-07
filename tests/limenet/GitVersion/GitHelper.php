<?php

namespace limenet\GitVersion;

use Ramsey\Uuid\Uuid;

class GitHelper
{
    public static function clone($repo)
    {
        $dir = Uuid::uuid4()->toString();

        $descriptorspec = [
           0 => ['pipe', 'r'],  // stdin
           1 => ['pipe', 'w'],  // stdout
           2 => ['pipe', 'w'],  // stderr
        ];

        $process = proc_open('git clone '.$repo.' '.$dir, $descriptorspec, $pipes, TEMPDIR);

        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        // It is important that you close any pipes before calling
        // proc_close in order to avoid a deadlock
        proc_close($process);

        return TEMPDIR.'/'.$dir;
    }
}
