<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Shorter extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'shorter';
    }

}
