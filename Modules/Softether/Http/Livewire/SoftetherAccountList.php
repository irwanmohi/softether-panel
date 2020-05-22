<?php

namespace Modules\Softether\Http\Livewire;

use App\User;
use Modules\Softether\Entities\SoftetherAccount;
use Livewire\Component;

class SoftetherAccountList extends Component
{
    public $readyToLoad = false;

    public $user;

    public $accounts = [];

    protected $listeners = [
        'AccountUpdated' => '$refresh'
    ];

    public function mount(User $user) {
        $this->user = $user;
    }

    public function render()
    {
        return view('softether::livewire.softether-account-list');
    }

    public function loadAccounts() {

        $this->accounts = SoftetherAccount::select();

        if( ! $this->user->isAdmin() ) {
            $this->accounts->where('user_id', $this->user->id);
        }

        $this->accounts = $this->accounts->get();

        $this->readyToLoad = true;
    }
}
