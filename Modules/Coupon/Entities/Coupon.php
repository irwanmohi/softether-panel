<?php

namespace Modules\Coupon\Entities;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'created_by', 'redeemed_by', 'coupon', 'amount',
        'message', 'is_redeemed', 'valid_until'
    ];
}
