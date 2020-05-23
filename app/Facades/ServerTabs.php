<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ServerTabs extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'server-tabs';
    }

}
