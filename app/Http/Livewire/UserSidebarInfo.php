<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserSidebarInfo extends Component
{

    public $name, $email, $balance;

    protected $listeners = [
        'userUpdated' => 'updateUserInfo',
    ];

    public function mount($user) {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->balance = $user->balance;
    }

    public function render()
    {
        return view('livewire.user-sidebar-info');
    }

    public function updateUserInfo() {
        $this->name = user()->name;
        $this->email = user()->email;
        $this->balance = user()->balance;
    }
}
