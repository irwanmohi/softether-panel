<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;
use Modules\Softether\Entities\SoftetherAccount;

class UserProfile extends Component
{
    public $user, $name, $password, $email;

    public function mount(User $user) {
        $this->user = $user;

        $this->name   = $user->name;
        $this->email  = $user->email;
    }

    public function render()
    {
        $vpnAccounts = SoftetherAccount::select();

        if( ! $this->user->isAdmin() ) {
            $vpnAccounts->where('user_id', $this->user->id);
        }

        $vpnAccounts = $vpnAccounts->count();

        $reseller = User::select();

        if( ! $this->user->isAdmin() ) {
            $reseller->where('parent_id', $this->user->id);
        }
        else
        {
            $reseller->where('role', '!=', 'admin');
        }

        return view('livewire.user-profile', [
            'vpnAccounts' => $vpnAccounts,
            'reseller'    => $reseller->count()
        ]);
    }

    public function submit() {
        $this->validate([
            'name'   => 'required',
            'email'  => 'required|email'
        ]);

        if( $this->email != $this->user->email ) {
            $this->validate([
                'email' => 'unique:users,email'
            ]);
        }

        $updateData = [
            'name' => $this->name,
            'email' => $this->email
        ];

        if( ! is_null($this->password) ) {
            $this->validate([
                'password' => 'min:6'
            ]);

            $updateData['password'] = bcrypt($this->password);
        }

        $this->user->update($updateData);

        $this->emit('userUpdated');
    }
}
