<?php

namespace Modules\Coupon\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Modules\Coupon\Entities\Coupon;

class CouponRedeem extends Component
{
    public $code;

    public function render()
    {
        return view('coupon::livewire.coupon-redeem');
    }

    public function submit() {
        $this->validate([
            'code' => 'required'
        ]);

        $coupon = Coupon::where('coupon', $this->code)->first();

        if( ! $coupon instanceof Coupon ) {
            $this->resetState();

            return session()->flash('error_message', 'Gift Code does not exists.');
        }

        if( $coupon->is_redeemed ) {
            $this->resetState();

            return session()->flash('error_message', 'Gift Code already used.');
        }


        if(
            ! is_null($coupon->valid_until) &&
            now()->gt(Carbon::parse($coupon->valid_until))
        ) {
            $this->resetState();

            return session()->flash('error_message', 'Gift Code is expired.');
        }

        user()->increment('balance', $coupon->amount);

        $coupon->update([
            'is_redeemed' => true,
            'redeemed_by' => user()->id
        ]);

        if( ! is_null($coupon->message) ) {
            session()->flash('coupon_message', $coupon->message);
        }

        $this->resetState();
        $this->emit('CouponRedeemed', $coupon);
        $this->emitUp('CouponRedeemed', $coupon);
        $this->emit('userUpdated');
        $this->emitUp('userUpdated');

    }

    protected function resetState() {
        $this->code = null;
    }
}
