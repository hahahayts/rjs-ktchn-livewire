<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Cart</h2>
    
    <!-- Product List -->
    <ul class="divide-y divide-gray-200">
        @foreach ($orders as $order)
            <li class="py-6 flex flex-col sm:flex-row">
                <!-- Product Image -->
                <div class="flex-shrink-0 w-full sm:w-32 h-32 mb-4 sm:mb-0">
                    <img  src="{{ Storage::url('products/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-full h-full object-cover object-center rounded-md">
                </div>
                
                <!-- Product Details -->
                <div class="flex-1 ml-0 sm:ml-6 flex flex-col">
                    <div>
                        <div class="flex justify-between">
                            <h3 class="text-lg font-medium text-gray-900">{{ $order->product->name }}</h3>
                            <p class="ml-4 text-lg font-medium text-gray-900">₱{{ number_format($order->product->price, 2) }}</p>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">{{ $order->product->description ?? 'Authentic Filipino homemade product' }}</p>
                    </div>
                    
                    <div class="mt-4 flex-1 flex flex-col sm:flex-row sm:items-end justify-between">
                        <!-- Quantity Controls -->
                        <div class="flex items-center">
                            <span class="mr-3 text-sm font-medium text-gray-700">Quantity</span>
                            <div class="flex border border-gray-300 rounded-md">
                                <button wire:click='decreaseQuantity({{ $order->id }})'  class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-l-md">
                                    -
                                </button>
                                <div class="w-12 py-1 text-center border-l border-r border-gray-300">
                                    {{ $order->quantity }}
                                </div>
                                <button  wire:click='increaseQuantity({{ $order->id }})' class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-r-md">
                                    +
                                </button>
                            </div>
                        </div>
                        
                        <!-- Subtotal & Remove -->
                        <div class="mt-4 sm:mt-0 flex flex-col sm:items-end">
                            <p class="text-sm font-medium text-gray-900">Subtotal: ₱{{ number_format($order->quantity * $order->product->price, 2) }}</p>
                            <button wire:click="removeFromCart({{ $order->id }})" class="mt-2 text-sm font-medium text-red-600 hover:text-red-500">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    
    <!-- Order Summary and Checkout -->
    @if(count($orders) > 0)
        <div class="mt-8 border-t border-gray-200 pt-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Subtotal</p>
                <p>₱{{ number_format($orders->sum(function($order) { return $order->quantity * $order->product->price; }), 2) }}</p>
            </div>
            <p class="mt-1 text-sm text-gray-500">Shipping and taxes will be calculated at checkout.</p>
            <div class="mt-6">
                <button wire:click="checkout" class="w-full bg-orange-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Proceed to Checkout
                </button>
            </div>
            <div class="mt-4 flex justify-center">
                <a href="{{ url('/products') }}"  class="text-sm font-medium text-orange-600 hover:text-orange-500">
                    Continue Shopping
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-lg text-gray-600">Your cart is empty</p>
            <a href='/products' wire:navigate class="mt-4 inline-block px-6 py-2 bg-orange-500 text-white font-medium rounded-md hover:bg-orange-600">
                Browse Products
            </a>
        </div>
    @endif
</div>