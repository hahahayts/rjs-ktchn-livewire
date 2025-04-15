<header class="bg-red text-color px-5 py-4 shadow-md">
    <nav class="container mx-auto flex flex-wrap justify-between items-center">
        <div class="flex items-center">
            <div class="text-2xl font-bold text-yellow-400 mr-8">RJ's KTCHN</div>
            
            @guest          
            <ul class="flex gap-6 items-center">
                <li><a href="/" class="hover:text-yellow-200 transition-colors">Home</a></li>
                <li><a href="/location" class="hover:text-yellow-200 transition-colors">Location</a></li>
                <li><a href="/about" class="hover:text-yellow-200 transition-colors">Why RJ's KTCHN</a></li>           
            </ul>
            @endguest
        </div>
        
        <div class="flex items-center gap-4">
            @guest
                <livewire:auth.login />
            @endguest

            @auth
                <a href="/cart" class="relative hover:text-yellow-200 transition-colors">
                    <span class="text-2xl">🛒</span>
                    <span class="absolute -top-1 -right-1 bg-yellow-400 text-red-600 text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                        {{ $cartCount ?? 0 }}
                    </span>
                </a>
                <livewire:auth.logout />
            @endauth
        </div>
    </nav>
</header>