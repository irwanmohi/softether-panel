<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerSoftware extends Model
{
    protected $fillable = [
        'server_id', 'software', 'ports', 'active'
    ];
}
