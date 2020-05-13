<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ServerUtils extends Facade {

    /**
     * Return the container binding for the facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'server-utils';
    }
}
