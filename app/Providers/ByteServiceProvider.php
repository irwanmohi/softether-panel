<?php

namespace App\Providers;

use App\Services\Byte;
use Illuminate\Support\ServiceProvider;

class ByteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('byte', Byte::class);
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
