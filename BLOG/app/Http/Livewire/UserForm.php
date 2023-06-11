<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserForm extends Component
{

    public $user;

    public $password;

    public $mode = 'create';

    protected $rules = [
       
];

// protected $rules()
//     {
//         return [
//             'user.name' => 'required',
//             'user.email' =>' required|email|unique:users,email,' . $this->user->id ,
//             'password' => 'required',
//     ];
// }

    protected function rules()
    {
        return [
            'user.name' => 'required',
            'user.email' =>' required|email|unique:users,email,' . $this->user->id ,
            'password' => 'required',
    ];
}


    protected $messages = [
        'name.required' => 'Il nome è obbligatorio',
    ];

    protected $listeners = [
        'editUser'
];


    public function mount()
    {
        $this->newUser();
    }


    public function newUser()
    {
        $this->user = new User;
        $this->password = "";
    }


    public function update($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function submit()
    {
        $this->validate();

        $this->user->fill(['password' => Hash::make($this->password)])->save();

        //     User::create([
        //         'name' => $this->name,
        //         'email' => $this->email,
        //         'password' => Hash::make($this->password),
        // ]);

        session()->flash('success', 'Utente creato correttamente');

        $this->newUser();

        //VOLGIO AGGIORNARE IL COMPONENTE USERLIST
        $this->emitTo('users-list', 'loadUsers');
    }

    public function editUser($user_id)
    {
        $this->user = User::find($user_id);

        $this->password = '';

        $this->mode = 'edit';
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
