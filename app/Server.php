<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'name', 'ip', 'country', 'public_key', 'private_key',
        'current_state', 'status', 'setup_completed', 'setup_percentage',
        'status', 'online_status'
    ];

    protected $casts = [
        'setup_completed' => 'boolean'
    ];
}
