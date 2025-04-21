<?php

namespace App\Livewire\Components;

use App\Models\OrderItem;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $cartCount = 0;
    
    public function mount(){
        $this->cartCount();
    }

    #[On('cart-updated')]
    public function cartCount(){
        $this->cartCount = OrderItem::where('user_id', auth()->id())->count();

    }
    public function render()
    {
        return view('livewire.components.navbar');
    }
}
