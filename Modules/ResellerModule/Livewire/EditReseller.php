<?php

namespace Modules\ResellerModule\Livewire;

use App\User;
use Livewire\Component;

class EditReseller extends Component
{

    public $reseller;

    public $updated = false;

    public $onEditing = false;

    public $userId, $name, $email, $password, $balance;

    public $previousBalance = 0, $newBalance = 0;

    public function mount($reseller)  {
        $this->reseller = $reseller;

        $this->userId   = $reseller->id;
        $this->name     = $reseller->name;
        $this->email    = $reseller->email;
        $this->balance  = (int) $reseller->balance;
        $this->previousBalance = $reseller->balance;
    }

    public function updateResellerDetails() {

        $reseller = User::find($this->userId);

        $this->updated = false;

        $this->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'balance'   => 'required|integer|min:0'
        ]);

        if(
            ! user()->isAdmin() &&
            $reseller->parent_id !== user()->id
        ) {
            return;
        }

        if( $this->email != $this->reseller->email ) {

            $this->validate([
                'email'     => 'required|email|unique:App\User,email',
            ]);

        }

        $amount = $this->balance - $this->reseller->balance;

        if(
            ! user()->isAdmin() &&
            $reseller->parent_id === user()->id
        ) {

            // Update the reseller details.

            $reseller->update([
                'name' => $this->name,
                'email' => $this->email
            ]);

            if( ! is_null($this->password) ) {
                $reseller->update(['password' => bcrypt($this->password)]);
            }



            if($amount > 0 ) { // prevent negative value

                if( user()->balance >= $amount ) {

                    $reseller->increment('balance', $amount);
                    user()->decrement('balance', $amount);

                }
                else
                {
                    $this->addError('balance', sprintf('Your balance is not enough to add %s to reseller.', $amount));
                    return;
                }
            }
            else
            {

                $deductedAmount = $reseller->balance - $this->balance;

                // apply the deducted balance to the user.
                if( ! user()->isAdmin() ) {
                    user()->increment('balance', $deductedAmount);
                }

                $reseller->update(['balance' => $this->balance]);

            }

        }

        if( user()->isAdmin() ) {

            $reseller->update([
                'name' => $this->name,
                'email' => $this->email
            ]);

            if( ! is_null($this->password) ) {
                $reseller->update(['password' => bcrypt($this->password)]);
            }

            if( $amount > 0 ) {
                $reseller->increment('balance', $amount);
            }

        }

        $this->newBalance = $reseller->balance;

        $this->updated = true;
        $this->emit('resellerUpdated');
        $this->emit('userUpdated');

    }

    public function render()
    {
        return view('resellermodule::livewire.edit-reseller');
    }
}
