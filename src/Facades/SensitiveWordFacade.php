<?php

namespace MyController\SensitiveWord\Facades;

use Illuminate\Support\Facades\Facade;

class SensitiveWordFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MyController.SensitiveWord';
    }
}
