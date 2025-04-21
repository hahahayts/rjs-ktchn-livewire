<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Our Products</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Discover the authentic flavors of the Philippines with our homemade products.
        </p>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- Product Card -->
        @foreach ($products as $p)

        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="relative pb-2/3">
                <img src="{{ Storage::url('products/' . $p->image) }}" alt="{{ $p->name }}" class="w-full h-64 object-cover">
            </div>
            <div class="p-4">
                <h2 class="text-xl font-bold text-gray-800 capitalize">{{$p->name}}</h2>
                <p class="text-gray-500 text-sm truncate capitalize">{{$p->description}}</p>
                <div class="mt-2 flex justify-between items-center">
                    <p class="text-lg font-semibold text-orange-600">₱{{$p->price}}</p>
                    <button wire:click='addToCart({{ $p->id }})'  class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    @endforeach


    </div>


 {{-- <!-- Alpine Toast -->
 <div 
 x-data="{ show: false, message: '' }"
 x-show="show"
 x-transition
 x-init="
     window.addEventListener('cart-update', e => {
         message = 'Added to cart.';
         show = true;
         setTimeout(() => show = false, 3000);
     });
 "
 class="fixed bottom-6 right-6 bg-green-500 text-white font-semibold px-6 py-3 rounded-lg shadow-lg"
 style="display: none;"
>
 <span x-text="message"></span>
</div> --}}
</div>





