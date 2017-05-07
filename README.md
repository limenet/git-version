# git-version
[![Build Status](https://travis-ci.org/limenet/smarty-partition.svg?branch=master)](https://travis-ci.org/limenet/smarty-partition)
[![Latest Stable Version](https://poser.pugx.org/limenet/smarty-partition/v/stable)](https://packagist.org/packages/limenet/smarty-partition)
[![License](https://poser.pugx.org/limenet/smarty-partition/license)](https://packagist.org/packages/limenet/smarty-partition)
[![Total Downloads](https://poser.pugx.org/limenet/smarty-partition/downloads)](https://packagist.org/packages/limenet/smarty-partition)
[![StyleCI](https://styleci.io/repos/29427550/shield)](https://styleci.io/repos/29427550)
[![codecov](https://codecov.io/gh/limenet/smarty-partition/branch/master/graph/badge.svg)](https://codecov.io/gh/limenet/smarty-partition)

## Usage

```php
<?php

use limenet\GitVersion\Version;
use limenet\GitVersion\Formatters\SemverFormatter;

$gitVersion = new Version($baseDir);
$version = $gitVersion->get(new SemverFormatter());

```