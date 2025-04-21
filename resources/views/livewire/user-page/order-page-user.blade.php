<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Cart</h2>
    
    <!-- Product List -->
    <ul class="divide-y divide-gray-200">
        @foreach ($orders as $order)
            <li class="py-6 flex flex-col sm:flex-row">
                <!-- Product Image -->
                <div class="flex-shrink-0 w-full sm:w-32 h-32 mb-4 sm:mb-0">
                    <img src="{{ Storage::url('products/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-full h-full object-cover object-center rounded-md">
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
                                <button wire:click='increaseQuantity({{ $order->id }})' class="px-3 py-1 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-r-md">
                                    +
                                </button>
                            </div>
                        </div>
                        
                        <!-- Subtotal & Remove -->
                        <div class="mt-4 sm:mt-0 flex flex-col sm:items-end">
                            <p class="text-sm font-medium text-gray-900">Subtotal: ₱{{ number_format($order->quantity * $order->product->price, 2) }}</p>
                            <button wire:click="removeOrder({{ $order->id }})" class="mt-2 text-sm font-medium text-red-600 hover:text-red-500">
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
        <div 
        x-data="{ showOrderInfo: false }"
        x-on:keydown.escape.prevent.stop="showOrderInfo = false"
        x-on:focusin.window="!$el.contains($event.target) && (showOrderInfo = false)"
        @click.away="showOrderInfo = false"
        class="mt-8 border-t border-gray-200 pt-6">
            <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Subtotal</p>
                <p>₱{{ number_format($orders->sum(function($order) { return $order->quantity * $order->product->price; }), 2) }}</p>
            </div>
            <p class="mt-1 text-sm text-gray-500">Shipping and taxes will be calculated at checkout.</p>
            <div class="mt-6">
                <button
                x-on:click="showOrderInfo = true"
                class="w-full bg-orange-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Proceed to Checkout
                </button>
            </div>
            <div class="mt-4 flex justify-center">
                <a href="{{ url('/products') }}" class="text-sm font-medium text-orange-600 hover:text-orange-500">
                    Continue Shopping
                </a>
            </div>
            
            <!-- Enhanced Modal -->
            <div x-show="showOrderInfo" 
                x-transition:enter="transition ease-out duration-300" 
                x-transition:enter-start="opacity-0 transform scale-90" 
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-300" 
                x-transition:leave-start="opacity-100 transform scale-100" 
                x-transition:leave-end="opacity-0 transform scale-90"
                class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                
                <!-- Background overlay -->
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    
                    <!-- Modal panel -->
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Complete Your Order
                                    </h3>
                                    
                                    <!-- Form -->
                                    <div class="mt-4">
                                        <form wire:submit.prevent="placeOrder" class="space-y-4">
                                            <!-- Customer Information -->
                                            <div>
                                                <h4 class="text-md font-medium text-gray-700 mb-2">Customer Information</h4>
                                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                                                    <div>
                                                        <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
                                                        <input type="text" id="firstName" wire:model="firstName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                    </div>
                                                    <div>
                                                        <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
                                                        <input type="text" id="lastName" wire:model="lastName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                    <input type="email" id="email" wire:model="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                                    <input type="tel" id="phone" wire:model="phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                </div>
                                            </div>
                                            
                                            <!-- Shipping Information -->
                                            <div>
                                                <h4 class="text-md font-medium text-gray-700 mb-2">Shipping Address</h4>
                                                <div class="mt-3">
                                                    <label for="address" class="block text-sm font-medium text-gray-700">Complete Address</label>
                                                    <textarea id="address" wire:model="address" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500"></textarea>
                                                </div>
                                                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 mt-3">
                                                    <div>
                                                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                                        <input type="text" id="city" wire:model="city" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                    </div>
                                                    <div>
                                                        <label for="postalCode" class="block text-sm font-medium text-gray-700">Postal Code</label>
                                                        <input type="text" id="postalCode" wire:model="postalCode" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Payment Method -->
                                            <div>
                                                <h4 class="text-md font-medium text-gray-700 mb-2">Payment Method</h4>
                                                <div class="mt-2 space-y-2">
                                                    <div class="flex items-center">
                                                        <input id="cod" name="paymentMethod" type="radio" wire:model="paymentMethod" value="cod" class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-300">
                                                        <label for="cod" class="ml-3 block text-sm font-medium text-gray-700">
                                                            Cash on Delivery
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="bank" name="paymentMethod" type="radio" wire:model="paymentMethod" value="bank" class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-300">
                                                        <label for="bank" class="ml-3 block text-sm font-medium text-gray-700">
                                                            Bank Transfer
                                                        </label>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <input id="gcash" name="paymentMethod" type="radio" wire:model="paymentMethod" value="gcash" class="focus:ring-orange-500 h-4 w-4 text-orange-600 border-gray-300">
                                                        <label for="gcash" class="ml-3 block text-sm font-medium text-gray-700">
                                                            GCash
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Order notes -->
                                            <div>
                                                <label for="notes" class="block text-sm font-medium text-gray-700">Order Notes (Optional)</label>
                                                <textarea id="notes" wire:model="notes" rows="2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-orange-500 focus:border-orange-500"></textarea>
                                            </div>
                                            
                                            <!-- Order Summary -->
                                            <div class="bg-gray-50 p-4 rounded-md">
                                                <h4 class="text-md font-medium text-gray-700 mb-2">Order Summary</h4>
                                                <div class="flex justify-between text-sm">
                                                    <span>Subtotal</span>
                                                    <span>₱{{ number_format($orders->sum(function($order) { return $order->quantity * $order->product->price; }), 2) }}</span>
                                                </div>
                                                <div class="flex justify-between text-sm mt-1">
                                                    <span>Shipping Fee</span>
                                                    <span>₱100.00</span>
                                                </div>
                                                <div class="flex justify-between font-medium text-md mt-2 pt-2 border-t border-gray-200">
                                                    <span>Total</span>
                                                    <span>₱{{ number_format($orders->sum(function($order) { return $order->quantity * $order->product->price; }) + 100, 2) }}</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" wire:click="placeOrder" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-orange-500 text-base font-medium text-white hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Place Order
                            </button>
                            <button type="button" @click="showOrderInfo = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
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