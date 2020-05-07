<?php

namespace App\Providers;

use App\Registries\InfoboxRegistry;
use App\Services\Infobox;
use Illuminate\Support\ServiceProvider;

class InfoboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(InfoboxRegistry::class);

        $this->registerBoxes();

        $this->app->bind(
            'infobox',
            Infobox::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected function registerBoxes() {
        $boxes = config('infobox');

        if( ! is_array($boxes) ) return;

        foreach($boxes as $key => $box) {

            $this->app->make(InfoboxRegistry::class)->register(
                $key, $this->app->make($box)
            );

        }
    }

}
