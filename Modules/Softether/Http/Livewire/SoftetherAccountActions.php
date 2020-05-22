<?php

namespace Modules\Softether\Http\Livewire;

use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Jobs\DeleteSoftetherAccount;
use Modules\Softether\Jobs\UnlockSoftetherAccount;
use Modules\Softether\Jobs\LockSoftetherAccount;

class SoftetherAccountActions extends Component
{

    public $index;

    public $account;

    public $deleteButton = false;

    public $accountLocked;

    public function mount(SoftetherAccount $account, $index = 1) {
        $this->account = $account;
        $this->index   = $index;
        $this->accountLocked = (bool) $account->is_locked;
    }

    public function render()
    {
        return view('softether::livewire.softether-account-actions');
    }

    public function deleteAccount($id) {
        $account = SoftetherAccount::find($id);

        DeleteSoftetherAccount::dispatch($account);

        $this->emit('AccountUpdated');
        $this->emitUp('AccountUpdated');
        $this->emitSelf('AccountUpdated');
        $this->emit('userUpdated');
    }

    public function unlockAccount($id) {

        $account = SoftetherAccount::find($id);

        UnlockSoftetherAccount::dispatch($account);

        $this->emit('AccountUpdated');
        $this->emitUp('AccountUpdated');
        $this->emitSelf('AccountUpdated');
        $this->emit('userUpdated');
    }

    public function lockAccount($id) {

        $account = SoftetherAccount::find($id);

        LockSoftetherAccount::dispatch($account);

        $this->emit('AccountUpdated');
        $this->emitUp('AccountUpdated');
        $this->emitSelf('AccountUpdated');
        $this->emit('userUpdated');
    }
}
