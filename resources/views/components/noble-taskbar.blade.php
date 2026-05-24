<div id="noble-taskbar" class="fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] w-max select-none" style="touch-action: none;">
    <div class="bg-forest/90 backdrop-blur-2xl border border-sunlight/10 rounded-full px-8 py-4 flex items-center gap-10 shadow-2xl shadow-black/40">
        <!-- Drag Handle (6 dots) -->
        <div id="taskbar-drag-handle" class="group/handle flex items-center justify-center p-2 hover:bg-white/5 rounded-full transition-all -ml-3 -mr-3" style="cursor: move;" title="Drag to move">
            <svg class="w-4 h-4 text-sunlight/40 group-hover/handle:text-sunlight transition-colors" fill="currentColor" viewBox="0 0 20 20">
                <path d="M7 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm6-12a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm0 6a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
            </svg>
        </div>

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
        
        <!-- Broadcasts (For Farmers and Suppliers) -->
        <a href="{{ route('farmer-requests.index') }}" 
           class="group flex flex-col items-center gap-1.5 transition-all {{ request()->routeIs('farmer-requests.index') ? 'text-gold' : 'text-sunlight/50 hover:text-sunlight' }}">
            <div class="relative">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-y-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                </svg>
                @if(request()->routeIs('farmer-requests.index'))
                    <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-gold rounded-full"></span>
                @endif
            </div>
            <span class="text-[9px] font-bold uppercase tracking-widest">{{ auth()->user()->role === 'farmer' ? 'Broadcast' : 'Demand' }}</span>
        </a>

        <!-- Cart -->
        @if(auth()->user()->role === 'farmer')
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
        @endif

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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const taskbar = document.getElementById('noble-taskbar');
    const handle = document.getElementById('taskbar-drag-handle');
    if (!taskbar || !handle) return;

    let isDragging = false;
    let startX, startY;
    let currentX = 0, currentY = 0;

    // Restore position from localStorage
    const savedPos = localStorage.getItem('taskbar-position');
    if (savedPos) {
        try {
            const pos = JSON.parse(savedPos);
            taskbar.style.bottom = 'auto';
            taskbar.style.left = pos.x + 'px';
            taskbar.style.top = pos.y + 'px';
            taskbar.style.transform = 'none';
            currentX = pos.x;
            currentY = pos.y;
        } catch(e) {}
    }

    handle.addEventListener('pointerdown', (e) => {
        isDragging = true;
        taskbar.setPointerCapture(e.pointerId);
        
        // Get current bounding box
        const rect = taskbar.getBoundingClientRect();
        
        // Offset of the click relative to the taskbar's top-left corner
        startX = e.clientX - rect.left;
        startY = e.clientY - rect.top;
    });

    taskbar.addEventListener('pointermove', (e) => {
        if (!isDragging) return;
        
        // Calculate new position
        let x = e.clientX - startX;
        let y = e.clientY - startY;

        // Keep within viewport boundaries
        const rect = taskbar.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        x = Math.max(0, Math.min(x, viewportWidth - rect.width));
        y = Math.max(0, Math.min(y, viewportHeight - rect.height));

        // Apply styles
        taskbar.style.bottom = 'auto';
        taskbar.style.left = x + 'px';
        taskbar.style.top = y + 'px';
        taskbar.style.transform = 'none';
        
        currentX = x;
        currentY = y;
    });

    taskbar.addEventListener('pointerup', (e) => {
        if (!isDragging) return;
        isDragging = false;
        taskbar.releasePointerCapture(e.pointerId);
        
        // Save position to localStorage
        localStorage.setItem('taskbar-position', JSON.stringify({ x: currentX, y: currentY }));
    });

    taskbar.addEventListener('pointercancel', (e) => {
        isDragging = false;
    });
});
</script>
