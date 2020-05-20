<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;

class SoftetherHowToConnect extends Component
{
    public $softetherAccount;

    public function mount(SoftetherAccount $softetherAccount) {
        $this->softetherAccount = $softetherAccount;
    }

    public function render()
    {
        return view('softether::livewire.softether-how-to-connect');
    }
}
