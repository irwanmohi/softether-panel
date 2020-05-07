<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Infobox extends Facade {

    /**
     * Return the container binding for the facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'infobox';
    }
}
