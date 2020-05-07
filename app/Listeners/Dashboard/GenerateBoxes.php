<?php

namespace App\Listeners\Dashboard;

use Infobox;
use App\Contracts\Concerns\Colors;
use App\Contracts\Infobox as InfoboxContract;
use App\Events\Dashboard\DashboardLoading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateBoxes
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
    public function handle(DashboardLoading $event)
    {
        //
    }
}
