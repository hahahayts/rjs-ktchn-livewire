<div class="bg-gray-800 h-screen w-64 fixed left-0 top-0 shadow-lg flex flex-col">
    <!-- Logo Section -->
    <div class="flex items-center justify-center py-6 border-b border-gray-700">
        <img src="{{ asset('assets/LOGO.jpg') }}" alt="RJ's KTCHN Logo" class="h-12 w-auto">
    </div>

    <!-- Admin Info Section -->
    <div class="flex items-center px-4 py-5 border-b border-gray-700">
        <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center mr-3">
            <span class="text-white font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
        </div>
        <div>
            <h3 class="text-white font-medium">{{ auth()->user()->name }}</h3>
            <p class="text-gray-400 text-sm">Administrator</p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 py-4">
        <p class="px-4 text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Main Menu</p>
        
        <a href="{{ url('/admin/dashboard') }}" wire:navigate class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <a href="{{ url('/admin/orders') }}" wire:navigate class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg mx-2 mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            Orders
        </a>

        <a href="/admin/products" wire:navigate class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg mx-2 mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Products
        </a>

        <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg mx-2 mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Users
        </a>

        <p class="px-4 text-xs font-medium text-gray-400 uppercase tracking-wider mb-2 mt-6">Settings</p>

        <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg mx-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
        </a>
    </nav>

    <!-- Logout Section -->
    <div class="px-4 py-4 border-t border-gray-700">
        <button wire:click="logout" class="flex items-center w-full px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white transition rounded-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Logout
        </button>
    </div>
</div>