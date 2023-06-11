<?php

namespace App\Http\Livewire;

use App\models\User;
use Livewire\Component;

class UsersList extends Component
{

    public $users;

    protected $listeners = [
        'loadUsers'
    ];

    public function mount()
    {
        $this->loadUsers();
    }

    public function loadUsers()
    {
        $this->users = User::all();
    }

    public function delete(User $user)
    {
        $user->delete();
        $this->loadUsers();
    }

    public function edit($user_id)
    {
        $this->emitTo('user-form', 'editUser', $user_id);
    }

    public function render()
    {
        return view('livewire.users-list');
    }
}
