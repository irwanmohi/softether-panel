<?php

namespace App\Providers;

use App\Services\ServerTabs;
use App\Services\ServerTab;
use App\Services\ServerUtils;
use App\Contracts\Server\Service;
use App\Contracts\Server\ServerTab as ServerTabContracts;
use App\Services\Server\Service as ServerService;
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
        $this->app->bind('server-tabs', ServerTabs::class);
        $this->app->bind(Service::class, ServerService::class);
        $this->app->bind(ServerTabContracts::class, ServerTab::class);
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
