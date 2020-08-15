<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Entities\SoftetherServer;

class DeleteServer extends Component
{

    public $destructionCode = 0;

    public $enteredDestructionCode;

    public $enableDeleteButton = false;

    public $server;

    public function mount(Server $server) {

        $this->destructionCode = rand(10000000, 99999999);
        $this->server = $server;
    }

    public function render()
    {
        return view('livewire.delete-server');
    }

    public function updatedEnteredDestructionCode($value) {
        $this->enableDeleteButton = ( $this->destructionCode == $value );

        if( $this->enableDeleteButton ) {
            $this->emit('enableDeleteButton');
        }
    }

    public function submit() {

        sleep(2);

        app(SoftetherAccount::class)->whereIn('softether_server_id', function($q) {
            $q->from('softether_servers')->select('id')->where('server_id', $this->server->id)->get();
        })->delete();

        app(SoftetherServer::class)->where('server_id', $this->server->id)->delete();

        $this->server->delete();

        $this->emit('ServerDeleted');
    }
}
