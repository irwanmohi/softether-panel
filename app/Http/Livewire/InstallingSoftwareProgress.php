<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;

class InstallingSoftwareProgress extends Component
{

    public $server;

    public function mount(Server $server, $softwareId) {
        $this->server = $server;
    }

    public function render()
    {
        return view('livewire.installing-software-progress');
    }

    public function refreshSetup() {
        if(
            $this->server->fresh()->setup_percentage >= 100 &&
            $this->server->fresh()->current_state == 'SETUP_COMPLETED'
        ) {
            return redirect(
                route('servers.show', [encrypt($this->server->id)])
            );
        }
    }
}
