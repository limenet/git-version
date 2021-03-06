# git-version
[![Build Status](https://travis-ci.org/limenet/git-version.svg?branch=master)](https://travis-ci.org/limenet/git-version)
[![Latest Stable Version](https://poser.pugx.org/limenet/git-version/v/stable)](https://packagist.org/packages/limenet/git-version)
[![License](https://poser.pugx.org/limenet/git-version/license)](https://packagist.org/packages/limenet/git-version)
[![Total Downloads](https://poser.pugx.org/limenet/git-version/downloads)](https://packagist.org/packages/limenet/git-version)
[![StyleCI](https://styleci.io/repos/29427550/shield)](https://styleci.io/repos/29427550)
[![codecov](https://codecov.io/gh/limenet/git-version/branch/master/graph/badge.svg)](https://codecov.io/gh/limenet/git-version)

## Usage

### Standalone

```php
<?php

use limenet\GitVersion\Directory;
use limenet\GitVersion\File;
use limenet\GitVersion\Formatters\SemverFormatter;

$directory = new Directory($baseDir);
$version = $directory->get(new SemverFormatter());

$file = new File($baseDir);
$version = $file->get(new SemverFormatter());

```

### Laravel

```php
$version = GitVersion::get();
```
