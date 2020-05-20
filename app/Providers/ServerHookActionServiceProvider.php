<?php

namespace App\Providers;

use App\Facades\ServerUtils;
use App\Services\Server\HookAction\RegisterServerSoftware;
use Illuminate\Support\ServiceProvider;

class ServerHookActionServiceProvider extends ServiceProvider
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
        ServerUtils::registerHookAction('register_server_software', RegisterServerSoftware::class);
    }
}
