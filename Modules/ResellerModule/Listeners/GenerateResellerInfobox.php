<?php

namespace Modules\ResellerModule\Listeners;

use Infobox;
use App\User;
use App\Contracts\Concerns\Colors;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Contracts\Infobox as InfoboxContract;
use App\Events\Dashboard\DashboardLoading;

class GenerateResellerInfobox
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
    public function handle(DashboardLoading $event)
    {
        if( user()->isAdmin() ) {

            Infobox::addBox('full-color', function(InfoboxContract $box) {
                $box->setTitle('Total Reseller');
                $box->setColor(Colors::PINK);
                $box->setIcon('assignment_ind');
                $box->setValue(User::where('role', 'reseller')->count());
            });

        }

        if( user()->role == 'reseller' ) {

            Infobox::addBox('full-color', function(InfoboxContract $box) {
                $box->setTitle('Total Sub-Reseller');
                $box->setColor(Colors::PINK);
                $box->setIcon('assignment_ind');
                $box->setValue(User::where('role', 'sub-reseller')->where('parent_id', user()->id)->count());
            });

        }
    }
}
