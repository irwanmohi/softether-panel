<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;

class SelectServerSoftware extends Component
{

    public $server;

    public $encryptedServerId;

    public function mount($id) {
        try {
            $this->server = Server::find(decrypt($id));
            $this->encryptedServerId = $id;

            if( ! $this->server ) return abort(404);
            if( $this->server->setup_completed ) return abort(404);
            if( $this->server->current_state != "CHOOSING_SOFTWARE" ) return abort(404);

        } catch(\Exception $e) {
            abort(404);
        }
    }


    public function render()
    {
        return view('livewire.select-server-software');
    }
}
