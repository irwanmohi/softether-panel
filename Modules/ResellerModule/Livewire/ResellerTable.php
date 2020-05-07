<?php

namespace Modules\ResellerModule\Livewire;

use App\User;
use Livewire\Component;

class ResellerTable extends Component
{

    public $resellers;

    public $standalone;

    public $previousBalance = 0, $newBalance = 0;

    protected $listeners = [
        'resellerUpdated' => 'updateResellers'
    ];

    public function mount($standalone = true) {

        $this->standalone = $standalone;

        $resellers = User::where('role', 'reseller')->where('id', '!=', user()->id);

        if( user()->role == 'reseller' ) {

            $resellers->where('parent_id', user()->id);

        }

        if( setting('reseller_module_allow_reseller_to_add_another_reseller')->value )  {

            $resellers->orWhere('role', 'sub-reseller');

        }

        $this->resellers = $resellers->get();
    }


    public function render()
    {
        return view('resellermodule::livewire.reseller-table');
    }

    public function updateResellers() {
        $resellers = User::where('role', 'reseller')->where('id', '!=', user()->id);

        if( user()->role == 'reseller' ) {

            $resellers->where('parent_id', user()->id);

        }

        if( setting('reseller_module_allow_reseller_to_add_another_reseller')->value )  {

            $resellers->orWhere('role', 'sub-reseller');

        }

        $this->resellers = $resellers->get();
    }

    public function deleteReseller($id) {

        $reseller = User::find($id);

        if(
            $reseller->parent_id === user()->id ||
            user()->isAdmin()
        ) {
            $reseller->delete();

            $this->emit('resellerUpdated');

            return;
        }

    }

    public function addBalanceToReseller($id, $amount) {

        $reseller = User::find($id);

        $this->previousBalance = $reseller->balance;

        if(

            ! user()->isAdmin() &&
            $reseller->parent_id === user()->id &&
            $reseller->balance >= $amount
        ) {

            $reseller->increment('balance', $amount);
            user()->decrement('balance', $amount);

        }

        if( user()->isAdmin() ) {
            $reseller->increment('balance', $amount);
        }

        $this->newBalance = $reseller->balance;

        $this->emit('resellerUpdated');
        $this->emit('userUpdated');

    }
}
