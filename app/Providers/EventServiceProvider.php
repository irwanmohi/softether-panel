<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\Dashboard\SidebarLoading::class => [
            \App\Listeners\Dashboard\GenerateMenu::class,
            \App\Listeners\Server\GenerateServerMenu::class,
        ],
        \App\Events\Dashboard\DashboardLoading::class => [
            \App\Listeners\Dashboard\GenerateBoxes::class,
            \App\Listeners\Server\GenerateServerInfobox::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
