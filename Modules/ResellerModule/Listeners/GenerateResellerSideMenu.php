<?php

namespace Modules\ResellerModule\Listeners;

use MenuManager;
use App\Contracts\SideMenuChild;
use App\Contracts\ToggleableSideMenu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateResellerSideMenu
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $resellerGroupMenu = app(ToggleableSideMenu::class)
                                ->setName("Reseller")
                                ->setUrl('/')
                                ->setIcon('assignment_ind');

        if( count(request()->segments()) >= 1 && request()->segment(1) == 'resellers' ) {
            $resellerGroupMenu->setActive();
        }

        $resellerMenus = [
            app(SideMenuChild::class)->setName('All Reseller')->setUrl(route('reseller-plugin.resellers.index')),
            app(SideMenuChild::class)->setName('Create New Reseller')->setUrl(route('reseller-plugin.resellers.create')),
        ];

        foreach($resellerMenus as $childMenu) {
            $resellerGroupMenu->addChild($childMenu);
        }

        MenuManager::addMenu($resellerGroupMenu, function() {
            return user()->role == 'admin' || (setting('reseller_module_allow_reseller_to_add_another_reseller')->value);
        });
    }
}
