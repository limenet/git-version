<?php

namespace limenet\GitVersion\Laravel;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Facade extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return 'git-version';
    }
}
