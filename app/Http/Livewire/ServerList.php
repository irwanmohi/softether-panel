<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;

class ServerList extends Component
{
    public $servers = [];

    public function render()
    {

        $servers = Server::all();

        $this->servers = $servers;

        return view('livewire.server-list');
    }

}
