<x-guest-layout>
    <x-slot name="title">Reset Password</x-slot>

    <h2 class="font-heading text-3xl text-forest mb-6 text-center">Recover Access</h2>

    <div class="mb-8 text-sm text-gray-500 leading-relaxed text-center italic">
        {{ __('Forgot your password? No problem. Enter your email and we\'ll send you a link to pick a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 mb-1" />
            <x-text-input id="email" class="block w-full px-5 py-4 bg-sage/20 border-sage/50 focus:ring-forest focus:border-forest rounded-2xl transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
        </div>

        <div class="pt-4">
            <x-primary-button class="w-full justify-center py-5 text-base shadow-xl shadow-forest/20 hover:shadow-forest/30 transition-all">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
        
        <div class="text-center pt-4">
            <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-forest transition-colors">Return to login</a>
        </div>
    </form>
</x-guest-layout>
