<?php

namespace App\Livewire\UserPage;

use App\Models\OrderItem;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrderPageUser extends Component
{

    #[Title('My Orders')]

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

    public function removeOrder($order_id){
        $order = OrderItem::find($order_id);
        $order->delete();
        $this->getOrders();

        $this->dispatch('cart-updated');  
    }

    public function getOrders(){
        $this->orders = OrderItem::where('user_id', auth()->user()->id)->get();

    }

    public function mount(){
        $this->getOrders();
    }
    
    public function render()
    {
        return view('livewire.user-page.order-page-user');
    }
}
