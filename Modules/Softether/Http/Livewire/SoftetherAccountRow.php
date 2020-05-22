<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;

class SoftetherAccountRow extends Component
{

    public $account;

    public function mount(SoftetherAccount $account) {
        $this->account = $account;
    }

    public function render()
    {
        return view('softether::livewire.softether-account-row');
    }

    public function deleteRow() {

    }
}
