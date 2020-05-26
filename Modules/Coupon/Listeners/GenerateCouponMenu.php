<?php

namespace Modules\Coupon\Listeners;

use MenuManager;
use App\Contracts\SideMenuChild;
use App\Contracts\ToggleableSideMenu;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateCouponMenu
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
                                ->setName("Coupon")
                                ->setUrl('/')
                                ->setIcon('card_giftcard');

        if( count(request()->segments()) >= 1 && request()->segment(1) == 'coupons' ) {
            $accountGroup->setActive();
        }

        $adminChild = [
            app(SideMenuChild::class)->setName('All Coupons')->setUrl(route('coupons.index')),
        ];

        $resellerChild = [

        ];

        if( user()->isAdmin() ) {
            foreach($adminChild as $child) {
                $accountGroup->addChild($child);
            }

        }
        else
        {
            foreach($resellerChild as $child) {
                $accountGroup->addChild($child);
            }
        }

        MenuManager::addMenu($accountGroup);
    }
}
