<nav x-data="{ open: false }" class="bg-transparent">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-24 items-center">
            <!-- Logo (Back on the Left) -->
            <div class="shrink-0 flex items-center">
                <a href="/" class="group">
                    <x-application-logo />
                </a>
            </div>

            <!-- Right Side Actions (Cart and Stuff) -->
            <div class="flex items-center gap-8">
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative group flex items-center gap-2 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/40 hover:text-earth transition-colors h-10">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Cart</span>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-2 bg-earth text-white text-[8px] w-4 h-4 flex items-center justify-center rounded-full shadow-lg">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>

                <!-- Sign Out -->
                <form method="POST" action="{{ route('logout') }}" class="flex items-center border-l border-forest/10 pl-8 h-10">
                    @csrf
                    <button type="submit" class="text-[10px] font-bold uppercase tracking-[0.2em] text-forest/40 hover:text-earth transition-colors">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

