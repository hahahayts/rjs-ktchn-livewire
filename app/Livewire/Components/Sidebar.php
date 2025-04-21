<?php

namespace App\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function logout(){
        Auth::logout();

        return redirect('/');
    }
    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
