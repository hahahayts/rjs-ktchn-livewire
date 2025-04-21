<?php

namespace App\Livewire\UserPage;

use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Component;

class ProductsPage extends Component
{
    public $products;

    public function mount(){
        $this->products = Product::get();
    }
    public function addToCart($productId){
        $product = Product::find($productId);
        OrderItem::create([
            'product_id' => $productId,
            'user_id' => auth()->id(),
            'name' => $product->name,
        ]);

        $this->dispatch('cart-updated');
    }
    public function render()
    {
        return view('livewire.user-page.products-page');
    }
}
