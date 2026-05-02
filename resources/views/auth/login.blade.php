<x-guest-layout>
    <x-slot name="title">Login</x-slot>

    <div class="w-full">
        <h2 class="font-heading text-4xl text-forest mb-1">Welcome back</h2>
        <p class="text-gray-500 mb-8 font-medium">Sign in to your account.</p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1" />
                <x-text-input id="email" class="block w-full px-4 py-3 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-1">
                    <x-input-label for="password" :value="__('Password')" class="text-[10px] font-bold uppercase tracking-widest text-gray-400" />
                    @if (Route::has('password.request'))
                        <a class="text-[10px] font-bold uppercase tracking-widest text-earth hover:text-forest transition-colors" href="{{ route('password.request') }}">
                            {{ __('Forgot?') }}
                        </a>
                    @endif
                </div>
                <x-text-input id="password" class="block w-full px-4 py-3 bg-sage/10 border-sage/30 focus:ring-forest focus:border-forest rounded-xl text-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <!-- Stay Signed In -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-md border-sage/50 text-forest shadow-sm focus:ring-forest w-4 h-4 transition-all" name="remember">
                <span class="ms-3 text-xs font-bold text-gray-500 uppercase tracking-tighter">{{ __('Stay signed in') }}</span>
            </div>

            <!-- Submit Button (High Visibility) -->
            <div class="pt-6">
                <x-primary-button class="w-full justify-center py-4 bg-forest text-white rounded-xl shadow-xl shadow-forest/20 hover:bg-earth transition-all">
                    <span class="text-sm font-bold uppercase tracking-[0.2em]">{{ __('Sign In') }}</span>
                </x-primary-button>
            </div>

            <p class="text-center text-xs font-medium text-gray-500 pt-4">
                New here? <a href="{{ route('register') }}" class="font-bold text-forest hover:text-earth underline transition-all">Create account</a>
            </p>
        </form>
    </div>
</x-guest-layout>
