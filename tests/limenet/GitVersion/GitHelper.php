<?php

namespace limenet\GitVersion;

use Ramsey\Uuid\Uuid;

class GitHelper {
    public static function clone($repo)
    {
        $dir = Uuid::uuid4()->toString();
        exec('cd '.TEMPDIR.' && git clone '.$repo.' '.$dir);

        return TEMPDIR.'/'.$dir;
    }
}