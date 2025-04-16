<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegisterPage extends Component
{
    
    #[Validate('required')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required|confirmed')]
    public $password = '';

    #[Validate('required')]
    public $password_confirmation = '';


    public function register(){
        $this->validate();

       $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt( $this->password),
        ]);

        $user->assignRole('user');

        Auth::login($user);


        return redirect('/products'); 

    }
    
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
