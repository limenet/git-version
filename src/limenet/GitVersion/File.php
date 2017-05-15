<?php

namespace limenet\GitVersion;

use limenet\GitVersion\Formatters\FormatterInterface;
use RuntimeException;

class File extends AbstractVersion
{
    protected function resolve(?FormatterInterface $formatter = null) : void
    {
        try {
            $commit = $this->resolver->getCommitFile();
        } catch (RuntimeException $e) {
            $commit = null;
        }

        $this->setExtraData([
            'commit' => $commit,
            'file' => pathinfo($this->target, PATHINFO_BASENAME)
        ]);
    }
}
