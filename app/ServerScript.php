<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerScript extends Model
{
    protected $fillable = [
        'server_id', 'script', 'fetched', 'last_fetch'
    ];

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
