<?php

namespace Modules\Softether\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;
use Modules\Softether\Jobs\CreateSoftetherAccount;
use Modules\Softether\Jobs\UpdateSoftetherAccount;

class EditSoftetherAccount extends Component
{
    public $updated = false;

    public $account;

    public $password;

    public $softetherServer;

    public $duration;

    public function mount(SoftetherAccount $account) {
        $this->account = $account;
        $this->softetherServer = $account->softetherServer;
        $this->username    = $account->username;
        $this->password    = decrypt($account->password);
    }

    public function render()
    {
        return view('softether::livewire.edit-softether-account');
    }

    public function updateAccountDetails() {

        $this->updated = false;

        if( ! is_null($this->duration) ) {
            // check user balance.
            if( ! user()->isAdmin() && ($this->softetherServer->account_price * (int) $this->duration) > user()->balance) {
                return session()->flash('error_message', 'Not enough balance to add user duration!');
            }
        }

        // all checks is passed. Update the user and dispatch job.

        $this->account->update([
            'password' => encrypt($this->password)
        ]);

        if( ! is_null($this->duration) ) {
            $this->account->update([
                'expired_date' => Carbon::parse($this->account->expired_date)->addMonths($this->duration)
            ]);

            if( ! user()->isAdmin() ) {
                user()->decrement('balance', (int) $this->duration * $this->softetherServer->account_price);
            }
        }

        $this->updated = true;
        $this->emit('AccountUpdated');
        $this->emitUp('AccountUpdated');
        $this->emitSelf('AccountUpdated');
        $this->emit('userUpdated');

        UpdateSoftetherAccount::dispatch($this->account);

    }
}
