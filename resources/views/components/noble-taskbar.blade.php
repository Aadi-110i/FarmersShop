<div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] w-max">
    <div class="bg-forest/90 backdrop-blur-2xl border border-sunlight/10 rounded-full px-8 py-4 flex items-center gap-10 shadow-2xl shadow-black/40">
        <!-- Overview / Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('dashboard') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
            <div class="relative">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                @if(request()->routeIs('dashboard'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                @endif
            </div>
            <span class="text-[9px] font-bold uppercase tracking-widest">Overview</span>
        </a>

        <!-- Marketplace -->
        <a href="{{ route('products.index') }}" 
           class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('products.index') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
            <div class="relative">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                @if(request()->routeIs('products.index'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                @endif
            </div>
            <span class="text-[9px] font-bold uppercase tracking-widest">Market</span>
        </a>

        <!-- My Inventory (For Suppliers) -->
        @if(auth()->user()->role === 'supplier')
            <a href="{{ route('products.my-products') }}" 
               class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('products.my-products') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
                <div class="relative">
                    <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    @if(request()->routeIs('products.my-products'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                    @endif
                </div>
                <span class="text-[9px] font-bold uppercase tracking-widest">Inventory</span>
            </a>
        @endif

        <!-- Cart -->
        <a href="{{ route('cart.index') }}" 
           class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('cart.index') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
            <div class="relative">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                @if(session()->has('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-1 -right-1 bg-earth text-white text-[8px] font-bold w-4 h-4 flex items-center justify-center rounded-full shadow-lg">
                        {{ count(session('cart')) }}
                    </span>
                @endif
                @if(request()->routeIs('cart.index'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                @endif
            </div>
            <span class="text-[9px] font-bold uppercase tracking-widest">Cart</span>
        </a>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" 
           class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('profile.edit') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
            <div class="relative">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                @if(request()->routeIs('profile.edit'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                @endif
            </div>
            <span class="text-[9px] font-bold uppercase tracking-widest">Profile</span>
        </a>
    </div>
</div>
