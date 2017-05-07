<?php

namespace limenet\GitVersion;

use limenet\GitVersion\Formatters\FormatterInterface;
use RuntimeException;

class File extends AbstractVersion
{
    protected function resolve(?FormatterInterface $formatter = null)
    {
        try {
            $commit = $this->resolver->getCommitFile();
        } catch (RuntimeException $e) {
            $commit = null;
        }

        $this->data['commit'] = $commit;
    }
}
