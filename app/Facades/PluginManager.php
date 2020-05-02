<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PluginManager extends Facade {

    /**
     * Get the container binding for the plugin.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'plugin-manager';
    }

}
