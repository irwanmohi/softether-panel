<?php

namespace Modules\ResellerModule\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateResellerWidgets
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
        if( user()->isAdmin() ) {
            \Widget::group('full-size')->addWidget('resellermoduleWidget::reseller_table_widget');
        }
    }
}
