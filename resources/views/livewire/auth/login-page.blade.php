<div class="min-h-screen w-full flex justify-center items-center bg-gray-50">
    <div class="flex rounded-xl shadow-xl overflow-hidden max-w-4xl w-full">
        <!-- Logo Section -->
        <div class="w-1/2 bg-red flex items-center justify-center p-8">
            <img src="{{ asset('assets/LOGO.jpg') }}" alt="RJ's KTCHN Logo" class="max-w-full h-auto">
        </div>
        
        <!-- Form Section -->
        <div class="w-1/2 bg-white p-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Welcome back to RJ's KTCHN</h1>
            
            <div class="h-1 w-16 bg-red mb-8"></div>
            
            <form wire:submit.prevent='login' class="space-y-6">
                
                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Enter your email..." 
                        class="w-full input-field"
                        wire:model.defer='email'
                        required
                    >
                    @error('email')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Enter your password..." 
                        class="w-full input-field"
                        wire:model.defer='password'
                        required
                    >
                    @error('password')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                  <!-- Error Message Area -->
            @if (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded">
                <p>{{ session('error') }}</p>
            </div>
        @endif
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember" 
                            class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded"
                            wire:model.defer="remember"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-700">
                            Remember me
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-600 hover:text-red-800 transition">
                            Forgot password?
                        </a>
                    @endif
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-red hover:opacity-90 text-color font-medium py-3 px-4 rounded-lg transition duration-300 shadow-sm"
                >
                <span wire:loading.class='hidden'>  Sign in</span>
                <span wire:loading>  Signing in...</span>
                </button>
                
                <div class="text-center mt-6">
                    <p class="text-gray-600 text-sm">
                        Don't have an account? 
                        <a href="{{ url('/register') }}" wire:navigate class="text-red-600 hover:text-red-800 font-medium">
                            Sign up
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>