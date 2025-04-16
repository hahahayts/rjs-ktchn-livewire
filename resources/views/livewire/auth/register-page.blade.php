<div class="min-h-screen w-full flex justify-center items-center bg-gray-50">
    <div class="flex rounded-xl shadow-xl overflow-hidden max-w-4xl w-full">
        <!-- Logo Section -->
        <div class="w-1/2 bg-red flex items-center justify-center p-8">
            <img src="{{ asset('assets/LOGO.jpg') }}" alt="RJ's KTCHN Logo" class="max-w-full h-auto">
        </div>
        
        <!-- Form Section -->
        <div class="w-1/2 bg-white p-10">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Register to RJ's KTCHN</h1>
            
            <div class="h-1 w-16 bg-red mb-8"></div>
            
            <form wire:submit.prevent="register" class="space-y-6">
                
                <div>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Enter your name..." 
                        class="w-full input-field"
                        wire:model.defer="name"
                        required
                    >
                    @error('name')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Enter your email..." 
                        class="w-full input-field"
                        wire:model.defer="email"
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
                        wire:model.defer="password"
                        required
                    >
                    @error('password')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        placeholder="Confirm your password..." 
                        class="w-full input-field"
                        wire:model.defer="password_confirmation"
                        required
                    >
                    @error('password_confirmation')
                        <p class="error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
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
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-red hover:opacity-90 text-color font-medium py-3 px-4 rounded-lg transition duration-300 shadow-sm disabled:opacity-70"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.class="hidden">Register</span>
                    <span wire:loading>Registering...</span>
                </button>
                
                <div class="text-center mt-6">
                    <p class="text-gray-600 text-sm">
                        Already have an account? 
                        <a href="{{ route('login') }}" wire:navigate class="text-red-600 hover:text-red-800 font-medium">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>