<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;

class SoftetherHowToConnect extends Component
{
    public $softetherAccount;

    public $enableSharing;

    protected $listeners = [
        'AccountUpdated' => '$refresh'
    ];

    public function mount(SoftetherAccount $softetherAccount) {
        $this->softetherAccount = $softetherAccount;

        $this->enableSharing = $softetherAccount->allow_sharing;
    }

    public function render()
    {
        return view('softether::livewire.softether-how-to-connect');
    }

    public function updatingEnableSharing() {
        sleep(1);

        $this->softetherAccount->update(['allow_sharing' => ! $this->enableSharing]);

        $this->emit('AccountUpdated');
    }
}
