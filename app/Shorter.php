<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shorter extends Model
{
    protected $fillable =[
        'short_id', 'target_url', 'expired_at', 'short_url'
    ];
}
