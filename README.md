# git-version
[![Build Status](https://travis-ci.org/limenet/git-version.svg?branch=master)](https://travis-ci.org/limenet/git-version)
[![Latest Stable Version](https://poser.pugx.org/limenet/git-version/v/stable)](https://packagist.org/packages/limenet/git-version)
[![License](https://poser.pugx.org/limenet/git-version/license)](https://packagist.org/packages/limenet/git-version)
[![Total Downloads](https://poser.pugx.org/limenet/git-version/downloads)](https://packagist.org/packages/limenet/git-version)
[![StyleCI](https://styleci.io/repos/29427550/shield)](https://styleci.io/repos/29427550)
[![codecov](https://codecov.io/gh/limenet/git-version/branch/master/graph/badge.svg)](https://codecov.io/gh/limenet/git-version)

## Usage

```php
<?php

use limenet\GitVersion\Version;
use limenet\GitVersion\Formatters\SemverFormatter;

$gitVersion = new Version($baseDir);
$version = $gitVersion->get(new SemverFormatter());

```