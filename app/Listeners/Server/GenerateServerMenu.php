<?php

namespace App\Listeners\Server;

use App\Contracts\SideMenuChild;
use MenuManager;
use App\Contracts\ToggleableSideMenu;
use App\Events\Dashboard\DashboardLoading;
use App\Facades\MenuManager as FacadesMenuManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateServerMenu
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DashboardLoading  $event
     * @return void
     */
    public function handle($event)
    {
        $serverGroup = app(ToggleableSideMenu::class)
            ->setName("Server")
            ->setIcon('dns');

        $serverGroup->addChild(
            app(SideMenuChild::class)
                ->setName("Add New Server")
                ->setUrl(route("servers.create"))
        );

        if( count(request()->segments()) >= 2 && request()->segment(2) == 'servers' ) {
            $serverGroup->setActive();
        }

        MenuManager::addMenu($serverGroup);
    }
}
