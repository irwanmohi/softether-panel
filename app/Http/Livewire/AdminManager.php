<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class AdminManager extends Component
{

    protected $listeners = [
        'AdminUpdated' => '$refresh',
        'AdminDeleted' => '$refresh'
    ];

    public function render()
    {

        $admins = User::where('parent_id', user()->id)->where('role', 'admin')->get();

        return view('livewire.admin-manager', [
            'admins' => $admins
        ]);
    }

    public function deleteAdmin($id) {
        User::where('id', $id)->delete();

        $this->emit('AdminUpdated');
        $this->emit('AdminDeleted');
    }

    public function convertToNonAdmin($id) {
        User::where('id', $id)->update(['role' => 'reseller']);

        $this->emit('AdminUpdated');
    }
}
