<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherServer;

class SoftetherServerCard extends Component
{

    public $server;

    public $softetherServer;

    public $style;

    public $withButton;

    public function mount(SoftetherServer $softetherServer, $style = null, $withButton = true) {
        $this->softetherServer = $softetherServer;
        $this->server          = $softetherServer->server;
        $this->style           = $style;
        $this->withButton      = $withButton;
    }

    public function render()
    {
        return view('softether::livewire.softether-server-card');
    }
}
