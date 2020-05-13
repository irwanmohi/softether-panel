<?php

namespace App\Listeners\Server;

use App\Server;
use Infobox as Box;
use App\Contracts\Infobox;
use App\Contracts\Concerns\Colors;
use App\Events\Dashboard\SidebarLoading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateServerInfobox
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
    public function handle($event)
    {
        Box::addBox('dual',
            function(Infobox $box) {
                $box->setTitle('Total Servers');
                $box->setValue(Server::count());
                $box->setColor(Colors::DEEP_PURPLE);
                $box->setIcon('dns');
            },
            function() {
                return user()->isAdmin();
            }
        );

        Box::addBox('dual',
            function(Infobox $box) {
                $box->setTitle('Online Servers');
                $box->setValue(Server::where('online_status', 'ONLINE')->count());
                $box->setColor(Colors::GREEN);
                $box->setIcon('power_settings_new');
            },
            function() {
                return user()->isAdmin();
            }
        );

        Box::addBox('dual',
            function(Infobox $box) {
                $box->setTitle('Offline Servers');
                $box->setValue(Server::where('online_status', 'OFFLINE')->count());
                $box->setColor(Colors::RED);
                $box->setIcon('report_problem');
            },
            function() {
                return user()->isAdmin();
            }
        );

    }
}
