<div>
    <!-- Login Button -->
    <div>  
        <button 
            wire:click="toggleModal" 
            class="py-2 px-5 border border-yellow-600 transition-colors hover:bg-yellow-600 hover:text-white rounded-xl font-medium"
        >
            Login
        </button>      
    </div>

    <!-- Modal Backdrop - prevents clicking behind modal -->
    <div 
        wire:show="showModal" 
        wire:click="toggleModal" 
        class="fixed inset-0 bg-black/30 bg-opacity-50 z-40 transition-opacity"
        wire:transition.duration.200
    ></div>

    <!-- Login Modal -->
    <div 
        wire:show="showModal" 
        wire:transition.duration.200 
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-md bg-white z-50 rounded-xl shadow-2xl py-8 px-6"
    >
        <!-- Close button -->
        <button 
            wire:click="toggleModal" 
            class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 transition-colors focus:outline-none focus:ring-2 focus:ring-red-500 rounded-full p-1"
            aria-label="Close login modal"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Login to RJ's KTCHN</h1>
            <p class="text-gray-500 text-sm mt-2">Enter your credentials to access your account</p>
        </div>
        
        <form class="space-y-4" wire:submit.prevent="login">
            <!-- Error Message Area -->
            @if (session()->has('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            
            <div class="flex flex-col">
                <label for="email" class="text-sm font-medium text-gray-700 mb-1">Email or Username</label>
                <input 
                    type="text" 
                    id="email"
                    wire:model.defer="email"
                    placeholder="Enter your email or username" 
                    class="input-field"
                    required
                >
                @error('email') 
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex flex-col">
                <label for="password" class="text-sm font-medium text-gray-700 mb-1">Password</label>
                <input 
                    type="password" 
                    id="password"
                    wire:model.defer="password"
                    placeholder="••••••••" 
                    class="input-field"
                    required
                >
                @error('password') 
                    <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        wire:model.defer="remember"
                        class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>
                <a href="#" wire:click.prevent="forgotPassword" class="text-sm font-medium text-red-600 hover:text-red-800">Forgot password?</a>
            </div>
            
            <button 
                type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-3 rounded-lg transition duration-200"
            >
              <span wire:loading.class='hidden'>  Sign in</span>
              <span wire:loading>  Signing in...</span>
            </button>
        </form>
        
        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm">Don't have an account? <a href="{{ url('/register') }}" wire:click.prevent="showRegister" class="text-red-600 font-medium hover:text-red-800">Sign up</a></p>
        </div>
    </div>
</div>