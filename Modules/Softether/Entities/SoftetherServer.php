<?php

namespace Modules\Softether\Entities;

use App\Server;
use Illuminate\Database\Eloquent\Model;

class SoftetherServer extends Model
{
    protected $fillable = [
        'server_id', 'account_price', 'server_ca',
        'psk', 'hub_name', 'hub_password', 'admin_password',
        'enable_vpn', 'enable_l2tp', 'allow_account_creation'
    ];

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
