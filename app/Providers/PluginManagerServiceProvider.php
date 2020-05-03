<?php

namespace App\Providers;

use Module;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Module as BaseModule;

//use Nwidart\Modules\Module;

class PluginManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        BaseModule::macro('getTitle', function() {
            $attributes = json_decode($this->json(), true);

            return isset($attributes['title']) ? $attributes['title'] : $attributes['name'];
        });
    }
}
