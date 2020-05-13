<?php

namespace App\Providers;

use App\Services\ServerUtils;
use Illuminate\Support\ServiceProvider;

class ServerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('server-utils', ServerUtils::class);
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
