<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate; 


class Login extends Component
{
    public  $showModal = false;

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

  

    public function toggleModal(){
        $this->showModal = !$this->showModal;
    }


    public function login(){
        $this->validate();

        if(Auth::attempt(['email'=> $this->email, 'password' => $this->password])){
            session()->regenerate();

            if(Auth::user()->hasRole('admin')){
                return redirect('/admin/dashboard');
            }
            return redirect('/products');

        }

        session()->flash('error', 'Invalid credentials.');

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
