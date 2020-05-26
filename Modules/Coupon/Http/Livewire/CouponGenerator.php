<?php

namespace Modules\Coupon\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Modules\Coupon\Entities\Coupon;

class CouponGenerator extends Component
{
    public $code, $amount, $expirationDate, $couponMessage;

    public function render()
    {
        return view('coupon::livewire.coupon-generator');
    }

    public function generateRandomCode() {

        $rand = [
            Str::random(20),
            Str::uuid(),
            md5(Str::random((20))),
            sprintf("SSHPANEL.IO-%s", rand(1, 99999999))
        ];


        $this->code = Str::upper(Arr::random($rand));
    }

    public function submit() {
        $this->validate([
            'amount' => 'required|int|min:1',
            'code'   => 'required'
        ]);

        if( Coupon::where('coupon', $this->code)->first() ) {
            return session()->flash('error_message', 'Coupon code already exists.');
        }


        $data = [
            'coupon' => $this->code,
            'amount' => $this->amount,
            'created_by' => user()->id,
        ];

        if( ! is_null($this->expirationDate)  ) {
            $data['valid_until'] = now()->addMonths((int) $this->expirationDate);
        }

        if( ! is_null($this->couponMessage) ) {
            $data['message'] = $this->couponMessage;
        }

        $coupon = Coupon::create($data);

        sleep(1);

        $this->emit('CouponCreated', $coupon);
        $this->emitUp('CouponCreated', $coupon);

    }
}
