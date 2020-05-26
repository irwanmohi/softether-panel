<?php

namespace Modules\Coupon\Widgets;

use Arrilot\Widgets\AbstractWidget;

class CouponTableWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('coupon::widgets.coupon_table_widget', [
            'config' => $this->config,
        ]);
    }
}
