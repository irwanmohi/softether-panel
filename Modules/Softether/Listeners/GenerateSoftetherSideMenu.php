<?php

namespace Modules\Softether\Listeners;

use MenuManager;
use App\Contracts\SideMenuChild;
use App\Contracts\ToggleableSideMenu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateSoftetherSideMenu
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
        $accountGroup = app(ToggleableSideMenu::class)
                                ->setName("VPN Account")
                                ->setUrl('/')
                                ->setIcon('vpn_key');

        if( count(request()->segments()) >= 2 && request()->segment(1) == 'softether' ) {
            $accountGroup->setActive();
        }

        $childMenus = [
            app(SideMenuChild::class)->setName('All VPN Accounts')->setUrl(route('softether.accounts.index')),
            app(SideMenuChild::class)->setName('Create VPN Accounts')->setUrl(route('softether.accounts.create')),
        ];

        foreach($childMenus as $childMenu) {
            $accountGroup->addChild($childMenu);
        }

        MenuManager::addMenu($accountGroup);
    }
}
