<?php

namespace App\Listeners\Dashboard;

use MenuManager;
use App\Contracts\SideMenu;
use App\Contracts\SideMenuChild;
use App\Contracts\ToggleableSideMenu;
use App\Events\Dashboard\SidebarLoading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateMenu
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
     * @param  SidebarLoading  $event
     * @return void
     */
    public function handle(SidebarLoading $event)
    {
        //
    }
}
