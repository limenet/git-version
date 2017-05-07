<?php

namespace limenet\GitVersion;

use InvalidArgumentException;
use RuntimeException;

class Resolver
{
    protected $target;

    public function __construct(string $target)
    {
        $this->target = $target;
    }

    public function getTag() : string
    {
        $tag = $this->runCommandInBasepath('git describe master --abbrev=0 --tags');

        return $tag;
    }

    public function getBranch() : string
    {
        $branch = $this->runCommandInBasepath('git rev-parse --abbrev-ref HEAD');
        $branch = str_replace('/', '_', $branch);

        return $branch;
    }

    public function getCommit() : string
    {
        $commit = $this->runCommandInBasepath('git rev-parse --short=7 HEAD');

        return $commit;
    }

    public function getCommitFile() : string
    {
        $commit = $this->runCommandInBasepath('git log -n 1 --format=%h '.basename($this->target));

        return $commit;
    }

    protected function runCommandInBasepath(string $command)
    {
        $descriptorspec = [
           0 => ['pipe', 'r'],  // stdin
           1 => ['pipe', 'w'],  // stdout
           2 => ['pipe', 'w'],  // stderr
        ];

        $process = proc_open($command, $descriptorspec, $pipes, is_file($this->target) ? pathinfo($this->target, PATHINFO_DIRNAME) : $this->target);

        $stderr = trim(stream_get_contents($pipes[2]));

        if (!empty($stderr)) {
            throw new RuntimeException($stderr);
        }

        $result = trim(stream_get_contents($pipes[1]));
        fclose($pipes[0]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        // It is important that you close any pipes before calling
        // proc_close in order to avoid a deadlock
        proc_close($process);

        return $result;
    }
}
