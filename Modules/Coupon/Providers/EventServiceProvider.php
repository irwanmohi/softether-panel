<?php

namespace Modules\Coupon\Providers;

use App\Events\Dashboard\SidebarLoading;
use App\Events\Dashboard\DashboardLoading;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Coupon\Listeners\GenerateCouponBoxes;
use Modules\Coupon\Listeners\GenerateCouponMenu;
use Modules\Coupon\Listeners\GenerateCouponWidgets;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DashboardLoading::class => [
            GenerateCouponBoxes::class,
            GenerateCouponWidgets::class
        ],
        SidebarLoading::class => [
            GenerateCouponMenu::class,
        ]
    ];

}
