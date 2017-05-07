<?php

namespace limenet\GitVersion;

use InvalidArgumentException;
use limenet\GitVersion\Formatters\FormatterInterface;
use RuntimeException;

class Version
{
    protected $basepath;

    protected $formatter;

    protected $data;

    protected $resolved;

    public function __construct(?string $path = null)
    {
        if ($path) {
            $this->setPath($path);
        }
    }

    public function setPath(string $path)
    {
        if (!file_exists($path)) {
            throw new InvalidArgumentException('Supplied non-existing path: '.$path);
        }

        $this->basepath = $path;
    }

    public function setFormatter(FormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    public function get(?FormatterInterface $formatter = null)
    {
        if ($formatter) {
            $this->setFormatter($formatter);
        }

        $this->check();

        $this->resolve();

        $this->formatter->setData($this->data);

        return $this->formatter->format();
    }

    protected function check()
    {
        if (!$this->formatter) {
            throw new InvalidArgumentException('No formatter set');
        }
    }

    protected function resolve()
    {
        if ($this->resolved) {
            return;
        }

        $resolver = new Resolver($this->basepath);

        $keys = ['tag', 'branch', 'commit'];

        foreach ($keys as $key) {
            $method = 'get'.ucfirst($key);

            try {
                $datum = $resolver->{$method}();
            } catch (RuntimeException $e) {
                $datum = null;
            }

            $this->data[$key] = $datum;
        }

        $this->resolved = true;
    }
}
