<?php

namespace Modules\Coupon\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenerateCouponWidgets
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
            \Widget::group('full-size')->addWidget('couponWidget::coupon_table_widget');
        }

        \Widget::group('half-size')->addWidget('couponWidget::redeem_coupon');
    }
}
