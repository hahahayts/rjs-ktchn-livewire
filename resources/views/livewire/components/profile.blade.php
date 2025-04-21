<div
    x-data="{ show: false }"
    x-on:keydown.escape.prevent.stop="show = false"
    x-on:focusin.window="!$el.contains($event.target) && (show = false)"
    @click.away="show = false"
    class="relative font-sans"
>
    <button
        x-on:click="show = !show"
        type="button"
        class="flex items-center justify-center rounded-full bg-amber hover:bg-amber-100 p-2 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
        :aria-expanded="show"
        aria-haspopup="true"
        aria-label="User menu"
    >
        <!-- User icon SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
        </svg>
    </button>

    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        x-cloak
        class="absolute right-0 z-10 mt-2 w-48 bg-white shadow-lg rounded-lg border border-gray-300 focus:outline-none overflow-hidden"
        tabindex="-1"
        role="menu"
    >
      
        <div class=" px-4 py-3 flex items-center gap-2 cursor-pointer hover:bg-amber-100" role="menuitem">
            <!-- Logout icon -->
            <i class="bi bi-box-arrow-in-right text-yellow-500"></i>
            <livewire:auth.logout />
        </div>
    </div>
</div>
