<div class="flex items-center gap-4 group {{ $attributes->get('class') }}">
    <div class="relative w-14 h-14 flex items-center justify-center">
        <!-- Background Decorative Ring -->
        <div class="absolute inset-0 rounded-2xl bg-forest/5 border border-forest/10 rotate-45 group-hover:rotate-90 transition-transform duration-700"></div>
        <!-- Innovative Abstract Leaf Logo -->
        <svg class="relative w-10 h-10 text-forest group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 22C12 22 20 18 20 12C20 6 12 2 12 2C12 2 4 6 4 12C4 18 12 22 12 22Z" fill="currentColor" fill-opacity="0.1"/>
            <path d="M12 22V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M12 12L17 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-earth"/>
            <path d="M12 16L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-earth"/>
            <path d="M12 12L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-earth"/>
            <path d="M12 16L8 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-earth"/>
            <path d="M12 2C12 2 4 6 4 12C4 18 12 22 12 22C12 22 20 18 20 12C20 6 12 2 12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div class="flex flex-col -gap-1">
        <span class="font-heading font-black text-2xl tracking-tighter text-forest leading-none uppercase">Terra</span>
        <span class="font-sans font-bold text-[10px] tracking-[0.4em] text-earth leading-none uppercase ml-0.5">Market</span>
    </div>
</div>
