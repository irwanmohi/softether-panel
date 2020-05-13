<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;

class ServerGeneralInfo extends Component
{
    public $server;

    public function mount(Server $server) {
        $this->server = $server;
    }

    public function render()
    {
        return view('livewire.server-general-info');
    }
}
