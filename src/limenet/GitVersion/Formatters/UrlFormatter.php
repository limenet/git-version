<?php

namespace limenet\GitVersion\Formatters;

use League\Uri\Components\Host;
use League\Uri\Components\Path;
use League\Uri\Components\Port;
use League\Uri\Components\Query;
use League\Uri\Components\Scheme;
use League\Uri\Schemes\Http as HttpUri;

class UrlFormatter extends AbstractFormatter
{
    public function __construct(?array $data = [])
    {
        if ($data) {
            $this->setExtraData($data);
        }
    }

    public function __toString() : string
    {
        $version = array_key_exists('version', $this->data) ? $this->data['version'] : $this->data['commit_short'];
        $versionQuery = 'v='.$version;

        $uri = HttpUri::createFromString($this->data['base'] ?? 'http://example.com');

        if (array_key_exists('scheme', $this->data)) {
            $uri = $uri->withScheme($this->data['scheme']);
        }
        if (array_key_exists('host', $this->data)) {
            $uri = $uri->withHost($this->data['host']);
        }
        if (array_key_exists('port', $this->data)) {
            $uri = $uri->withPort($this->data['port']);
        }
        if (array_key_exists('path', $this->data)) {
            $uri = $uri->withPath($this->data['path']);
        }
        if (array_key_exists('query', $this->data)) {
            $uri = $uri->withQuery($this->data['query'].'&'.$versionQuery);
        } else {
            $uri = $uri->withQuery($versionQuery);
        }

        return (string) $uri;
    }
}
