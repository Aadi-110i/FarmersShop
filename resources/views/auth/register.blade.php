<x-guest-layout>
    <x-slot name="title">Register</x-slot>

    <div class="w-full">
        <h2 class="font-heading text-4xl text-forest mb-1 text-center">Join us</h2>
        <p class="text-gray-500 mb-6 font-medium text-sm text-center">Create an account to start trading.</p>

        <form method="POST" action="{{ route('register') }}" x-data="{ role: 'farmer' }" class="space-y-4">
            @csrf

            <!-- Role Selection -->
            <div class="mb-4">
                <x-input-label :value="__('I want to...')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 text-center" />
                <div class="grid grid-cols-2 gap-2">
                    <!-- Farmer Card -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="role" value="farmer" class="peer sr-only" x-model="role" checked>
                        <div class="p-3 rounded-xl border-2 border-sage/30 bg-sage/5 transition-all group-hover:border-forest/30 peer-checked:border-forest peer-checked:bg-forest/5 flex flex-col items-center text-center">
                            <span class="text-2xl mb-1 grayscale peer-checked:grayscale-0 transition-all">🌱</span>
                            <span class="text-[10px] font-bold text-gray-400 peer-checked:text-forest uppercase">Buy Inputs</span>
                        </div>
                    </label>

                    <!-- Supplier Card -->
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="role" value="supplier" class="peer sr-only" x-model="role">
                        <div class="p-3 rounded-xl border-2 border-sage/30 bg-sage/5 transition-all group-hover:border-forest/30 peer-checked:border-forest peer-checked:bg-forest/5 flex flex-col items-center text-center">
                            <span class="text-2xl mb-1 grayscale peer-checked:grayscale-0 transition-all">🚜</span>
                            <span class="text-[10px] font-bold text-gray-400 peer-checked:text-forest uppercase">Sell Inputs</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Fields Container with tighter spacing -->
            <div class="space-y-3">
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1" />
                    <x-text-input id="name" class="block w-full px-4 py-2 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="John Doe" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-[10px]" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1" />
                    <x-text-input id="email" class="block w-full px-4 py-2 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm" type="email" name="email" :value="old('email')" required placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-[10px]" />
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1" />
                        <x-text-input id="password" class="block w-full px-4 py-2 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm" type="password" name="password" required placeholder="••••••••" />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1" />
                        <x-text-input id="password_confirmation" class="block w-full px-4 py-2 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm" type="password" name="password_confirmation" required placeholder="••••••••" />
                    </div>
                </div>
            </div>

            <!-- Submit Button (High Visibility) -->
            <div class="pt-6">
                <x-primary-button class="w-full justify-center py-4 bg-forest text-white rounded-xl shadow-xl shadow-forest/20 hover:bg-earth transition-all">
                    <span class="text-sm font-bold uppercase tracking-[0.2em]">{{ __('Create Account') }}</span>
                </x-primary-button>
            </div>

            <p class="text-center text-xs font-medium text-gray-500 pt-2">
                Already registered? <a href="{{ route('login') }}" class="font-bold text-forest hover:text-earth underline transition-all">Sign in</a>
            </p>
        </form>
    </div>
</x-guest-layout>
