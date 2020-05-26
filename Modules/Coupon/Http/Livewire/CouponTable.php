<?php

namespace Modules\Coupon\Http\Livewire;

use Livewire\Component;
use Modules\Coupon\Entities\Coupon;

class CouponTable extends Component
{
    public $coupons = [];

    protected $listeners = [
        'CouponGenerated' => '$refresh',
        'CouponCreated'   => '$refresh',
        'CouponRedeemed'  => '$refresh'
    ];

    public function render()
    {
        $this->coupons = Coupon::all();

        return view('coupon::livewire.coupon-table');
    }

}
