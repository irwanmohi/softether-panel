<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherServer;

class SelectSoftetherServer extends Component
{

    public $servers = [];

    public function render()
    {
        $servers = SoftetherServer::select('softether_servers.*')
            ->join('servers', function($join) {
                $join->on('servers.id', '=', 'softether_servers.server_id')
                     ->where('servers.online_status', 'ONLINE');
            })->get();


        $this->servers = $servers;

        return view('softether::livewire.select-softether-server');
    }
}
