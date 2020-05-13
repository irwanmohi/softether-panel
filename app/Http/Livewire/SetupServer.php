<?php

namespace App\Http\Livewire;

use App\Server;
use Livewire\Component;
use App\Facades\ServerUtils;
use App\Contracts\Server\ServerSoftware;

class SetupServer extends Component
{

    public $server;

    public $softwareId, $softwareName, $softwareDescription;

    protected $allowedState = [
        'INSTALLING_SOFTWARE', 'CHOOSING_SOFTWARE', 'TO_RUN_SOFTWARE_SCRIPT'
    ];

    public function mount($id, $software) {
        try {

            $serverId          = decrypt($id);
            $softwareId        = decrypt($software);
            $software          = ServerUtils::getSoftware($softwareId);
            $this->server      = Server::find($serverId);

            if(
                ! $this->server instanceof Server ||
                ! $software instanceof ServerSoftware ||
                ! in_array($this->server->current_state, $this->allowedState) ||
                $this->server->setup_completed
            ) {
                return abort(404);
            }

            // Entering TO_RUN_SOFTWARE_SCRIPT state.
            if( $this->server->current_state == 'CHOOSING_SOFTWARE' ) {
                $this->server->update(['current_state' => 'TO_RUN_SOFTWARE_SCRIPT']);
            }

            // Set the software properties.
            $this->softwareName         = $software->getName();
            $this->softwareDescription  = $software->getDescription();
            $this->softwareId           = $softwareId;

        } catch(\Exception $e)  {

            dd($e);

            return abort(404);

        }

    }


    public function render()
    {
        return view('livewire.setup-server');
    }
}

