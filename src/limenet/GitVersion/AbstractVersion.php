<?php

namespace limenet\GitVersion;

use InvalidArgumentException;
use limenet\GitVersion\Formatters\FormatterInterface;
use RuntimeException;

abstract class AbstractVersion
{
    protected $target;

    protected $formatter;

    protected $data;

    protected $resolver;
    protected $resolved;

    public function __construct(?string $target = null)
    {
        if ($target) {
            $this->setTarget($target);
        }
    }

    public function setTarget(string $target)
    {
        if (!file_exists($target)) {
            throw new InvalidArgumentException('Supplied non-existing target: '.$target);
        }

        $this->target = $target;
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

        $this->resolveBase();
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

    protected function resolveBase()
    {
        if ($this->resolved) {
            return;
        }

        $this->resolver = new Resolver($this->target);

        $keys = ['tag', 'branch', 'commit'];

        foreach ($keys as $key) {
            $method = 'get'.ucfirst($key);

            try {
                $datum = $this->resolver->{$method}();
            } catch (RuntimeException $e) {
                $datum = null;
            }

            $this->data[$key] = $datum;
        }

        $this->resolved = true;
    }

    abstract protected function resolve();
}
