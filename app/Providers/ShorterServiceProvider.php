<?php

namespace App\Providers;

use App\Services\Shorter;
use Illuminate\Support\ServiceProvider;

class ShorterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('shorter', Shorter::class);
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
}
