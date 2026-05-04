<nav x-data="{ open: false }" class="bg-white/70 backdrop-blur-xl border-b border-[var(--sage-green)] sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-10">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2 text-[var(--forest-green)]">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
                        <span class="font-heading font-bold text-xl tracking-tight">TerraMarket</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-sm font-bold text-[var(--forest-green)]">
                        {{ __('Overview') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')" class="text-sm font-bold text-[var(--forest-green)]">
                        {{ __('Marketplace') }}
                    </x-nav-link>
                    @if(auth()->user()->role === 'supplier')
                        <x-nav-link :href="route('products.my-products')" :active="request()->routeIs('products.my-products')" class="text-sm font-bold text-[var(--forest-green)]">
                            {{ __('My Inventory') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Side Navigation -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <!-- Cart Button -->
                <a href="{{ route('cart.index') }}" class="relative inline-flex items-center px-4 py-2 border border-[var(--sage-green)] text-sm leading-4 font-bold rounded-full text-[var(--forest-green)] bg-[var(--sage-green)]/30 hover:bg-[var(--sage-green)] transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Cart</span>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-earth text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full shadow-lg">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-[var(--sage-green)] text-sm leading-4 font-bold rounded-full text-[var(--forest-green)] bg-[var(--sage-green)]/30 hover:bg-[var(--sage-green)] transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('My Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Sign Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-[var(--forest-green)] bg-[var(--sage-green)]/30 hover:bg-[var(--sage-green)] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Overview') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Marketplace') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                {{ __('My Cart') }}
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <span class="ml-2 bg-earth text-white text-[10px] font-bold px-2 py-0.5 rounded-full">
                        {{ count(session('cart')) }}
                    </span>
                @endif
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[var(--sage-green)]">
            <div class="px-6 py-4">
                <div class="font-bold text-base text-[var(--forest-green)]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="space-y-1 pb-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('My Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Sign Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
