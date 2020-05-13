<?php

namespace Modules\ResellerModule\Providers;

use App\Events\Dashboard\SidebarLoading;
use App\Events\Dashboard\DashboardLoading;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\ResellerModule\Listeners\GenerateResellerInfobox;
use Modules\ResellerModule\Listeners\GenerateResellerSideMenu;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DashboardLoading::class => [
            GenerateResellerInfobox::class,
        ],
        SidebarLoading::class => [
            GenerateResellerSideMenu::class,
        ]
    ];
}
