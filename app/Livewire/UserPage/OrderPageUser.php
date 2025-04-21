<?php

namespace App\Livewire\UserPage;

use App\Models\OrderItem;
use Livewire\Component;

class OrderPageUser extends Component
{
    public $orders;
    public $order;

    public function increaseQuantity($order_id){
        $order = OrderItem::find($order_id);
        $order->quantity += 1;
        $order->save();

    }

    public function decreaseQuantity($order_id){
        $order = OrderItem::find($order_id);
        if($order->quantity > 0){
            $order->quantity -= 1;
            $order->save();
        }

    }

    public function mount(){
        $this->orders = OrderItem::where('user_id', auth()->user()->id)->get();

    }
    public function render()
    {
        return view('livewire.user-page.order-page-user');
    }
}
