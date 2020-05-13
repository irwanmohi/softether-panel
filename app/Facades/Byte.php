<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Byte extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'byte';
    }

}
