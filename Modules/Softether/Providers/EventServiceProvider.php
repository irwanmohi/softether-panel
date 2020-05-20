<?php

namespace Modules\Softether\Providers;

use App\Events\Dashboard\SidebarLoading;
use App\Events\Dashboard\DashboardLoading;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Softether\Listeners\GenerateSoftetherInfobox;
use Modules\Softether\Listeners\GenerateSoftetherSideMenu;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DashboardLoading::class => [
            GenerateSoftetherInfobox::class,
        ],
        SidebarLoading::class => [
            GenerateSoftetherSideMenu::class,
        ]
    ];
}
