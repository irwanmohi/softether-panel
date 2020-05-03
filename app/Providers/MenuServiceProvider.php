<?php

namespace App\Providers;

use App\Services\SideMenu\SideMenu;
use App\Services\SideMenu\MenuChild;
use App\Contracts\SideMenu as SideMenuContract;
use App\Contracts\SideMenuChild as SideMenuChildContract;
use App\Contracts\ToggleableSideMenu;
use App\Services\MenuManager;
use App\Services\SideMenu\ToggleableMenu;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'menu-manager',
            MenuManager::class
        );

        $this->app->bind(
            SideMenuContract::class,
            SideMenu::class
        );

        $this->app->bind(
            SideMenuChildContract::class,
            MenuChild::class
        );

        $this->app->bind(
            ToggleableSideMenu::class,
            ToggleableMenu::class
        );
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
