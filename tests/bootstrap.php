<?php

require_once __DIR__.'/../vendor/autoload.php';

define('TEMPDIR', realpath(__DIR__.'/..').'/build-test');
@mkdir(TEMPDIR);
