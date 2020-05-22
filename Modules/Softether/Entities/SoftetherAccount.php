<?php

namespace Modules\Softether\Entities;

use Illuminate\Database\Eloquent\Model;

class SoftetherAccount extends Model
{
    protected $fillable = [
        'username', 'password', 'status', 'price', 'user_id',
        'active_date', 'expired_date', 'account_cert', 'is_locked',
        'account_key', 'auth_type', 'outgoing_unicast_packets',
        'outgoing_unicast_size', 'outgoing_broadcast_packets',
        'outgoing_broadcast_size', 'incoming_unicast_packets',
        'incoming_unicast_size', 'incoming_broadcast_packets',
        'incoming_broadcast_size', 'total_logins', 'softether_server_id'
    ];

    protected $dates = [
        'expired_date'
    ];

    public function softetherServer() {
        return $this->belongsTo(SoftetherServer::class);
    }
}
