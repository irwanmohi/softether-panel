<?php

namespace App\Providers;

use App\Contracts\Server\Service;
use App\Services\Server\Service as ServerService;
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
        $this->app->bind(Service::class, ServerService::class);
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
