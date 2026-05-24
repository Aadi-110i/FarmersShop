<x-app-layout>
    <x-slot name="header">
        Noble Dashboard
    </x-slot>

    <div class="space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Welcome Card -->
            <div class="lg:col-span-2 bg-forest text-sunlight p-10 md:p-14 rounded-[3.5rem] shadow-2xl relative overflow-hidden group border border-forest/10">
                <div class="relative z-10 h-full flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-sunlight/10 text-sunlight/80 text-[10px] font-bold uppercase tracking-widest mb-8 border border-sunlight/5">
                            <span class="w-1.5 h-1.5 bg-earth rounded-full animate-pulse"></span>
                            Live Market Access
                        </div>
                        <h3 class="font-heading text-5xl md:text-6xl mb-6 leading-tight">Welcome, <br><span class="italic text-earth">{{ auth()->user()->name }}</span></h3>
                        <p class="text-sage/60 font-medium mb-12 max-w-lg text-lg leading-relaxed">
                            @if(auth()->user()->role === 'farmer')
                                Your dedication to the soil nourishes the world. Discover premium provisions curated for your next harvest.
                            @else
                                Your stewardship ensures the continuity of quality. Oversee your inventory and connect with the heart of agriculture.
                            @endif
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-4 bg-earth text-sunlight px-10 py-5 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:bg-earth/90 hover:scale-[1.02] transition-all shadow-xl shadow-black/20">
                            Enter the Marketplace
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-earth/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2 group-hover:bg-earth/20 transition-all duration-1000"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 border border-sunlight/5 rounded-full pointer-events-none group-hover:scale-110 transition-transform duration-1000"></div>
            </div>

            <!-- Stats & Profile Sidebar -->
            <div class="space-y-8">
                <!-- Insight Overview Card -->
                <div class="bg-white p-10 rounded-[3.5rem] border border-forest/5 flex flex-col justify-between shadow-sm hover:shadow-xl transition-shadow duration-500 relative overflow-hidden group">
                    <div class="relative z-10">
                        <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-8 block">Insight Overview</span>
                        @php
                            $stat_label = auth()->user()->role === 'farmer' ? 'Total Acquisitions' : 'Active Provisions';
                            $stat_count = auth()->user()->role === 'farmer' ? \App\Models\Order::where('user_id', auth()->id())->count() : \App\Models\Product::where('user_id', auth()->id())->count();
                        @endphp
                        <div class="mb-4">
                            <span class="text-8xl font-heading text-forest font-light tracking-tighter">{{ $stat_count }}</span>
                            <p class="text-forest/60 font-bold text-[10px] uppercase tracking-[0.2em] mt-2">{{ $stat_label }}</p>
                        </div>
                    </div>
                    <div class="pt-8 border-t border-forest/5 relative z-10">
                        <p class="text-[9px] text-forest/30 uppercase font-bold tracking-[0.3em] mb-3">Member Standing</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-2.5 h-2.5 bg-earth rounded-full shadow-[0_0_10px_rgba(140,106,83,0.5)]"></div>
                                <p class="font-bold text-forest text-xs uppercase tracking-widest">{{ auth()->user()->role }} Affiliate</p>
                            </div>
                            <span class="text-[10px] font-bold text-forest/20">VERIFIED</span>
                        </div>
                    </div>
                    <!-- Subtle Mesh Background -->
                    <div class="absolute inset-0 opacity-[0.03] pointer-events-none group-hover:opacity-[0.05] transition-opacity">
                        <svg width="100%" height="100%"><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1"/></pattern><rect width="100%" height="100%" fill="url(#grid)" /></svg>
                    </div>
                </div>

                <!-- Weather/Region Info (Flavor) -->
                <div class="bg-sage/30 p-8 rounded-[2.5rem] border border-forest/5 flex items-center justify-between">
                    <div>
                        <p class="text-[9px] font-bold text-forest/40 uppercase tracking-widest mb-1">Region Weather</p>
                        <p class="font-heading text-lg text-forest">24°C <span class="text-sm font-sans opacity-60 font-medium">Optimal for Sowing</span></p>
                    </div>
                    <div class="text-3xl">☀️</div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="pt-8">
            <div class="flex items-center gap-6 mb-12">
                @if(auth()->user()->role === 'farmer')
                    <h3 class="font-heading text-4xl text-forest shrink-0">Recent <span class="italic text-earth">Manifest</span></h3>
                @else
                    <h3 class="font-heading text-4xl text-forest shrink-0">Estate <span class="italic text-earth">Ledger</span></h3>
                @endif
                <div class="h-px w-full bg-forest/10"></div>
                <a href="#" class="shrink-0 text-[10px] font-bold text-forest/40 uppercase tracking-widest hover:text-earth transition-colors">View All</a>
            </div>
            
            @if(auth()->user()->role === 'farmer')
                <div class="bg-white rounded-[3.5rem] border border-forest/5 overflow-hidden shadow-sm">
                    @php $orders = \App\Models\Order::with(['product.reviews', 'product.user'])->where('user_id', auth()->id())->latest()->take(5)->get(); @endphp
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-forest/5">
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Provision</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Rating</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Volume</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Valuation</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Method</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-forest/5">
                                @forelse($orders as $order)
                                    @php
                                        $image_map = [
                                            'sprayer' => asset('images/products/sprayer.png'),
                                            'seeder' => asset('images/products/seeder.png'),
                                            'rake' => asset('images/products/rake.png'),
                                            'pickaxe' => asset('images/products/pickaxe.png'),
                                            'spade' => asset('images/products/sprayer.png'),
                                        ];

                                        $name = strtolower($order->product->name);
                                        $imgSrc = null;
                                        foreach ($image_map as $key => $url) {
                                            if (str_contains($name, $key)) {
                                                $imgSrc = $url;
                                                break;
                                            }
                                        }

                                        if (!$imgSrc) {
                                            $imgSrc = str_starts_with($order->product->image_url ?? '', '/')
                                                ? asset($order->product->image_url)
                                                : ($order->product->image_url ?? 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=200');
                                        }
                                    @endphp
                                    <tr class="group hover:bg-sage/10 transition-colors cursor-pointer" onclick="window.location='{{ route('products.show', $order->product) }}'">
                                        <td class="px-12 py-10">
                                            <a href="{{ route('products.show', $order->product) }}" class="flex items-center gap-4">
                                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-forest/5 flex-shrink-0 border border-forest/5">
                                                    <img src="{{ $imgSrc }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                </div>
                                                <div>
                                                    <span class="font-heading text-2xl text-forest group-hover:text-earth transition-colors block">{{ $order->product->name }}</span>
                                                    <span class="text-[9px] font-bold text-forest/30 uppercase tracking-[0.2em] mt-1 block">₹{{ number_format($order->product->price, 0) }} per unit</span>
                                                </div>
                                            </a>
                                        </td>
                                        <td class="px-12 py-10">
                                            <div class="flex items-center gap-2">
                                                <div class="flex text-gold">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-3 h-3 {{ $i <= round($order->product->average_rating) ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span class="text-[9px] font-bold text-forest/30">({{ $order->product->review_count }})</span>
                                            </div>
                                        </td>
                                        <td class="px-12 py-10">
                                            <span class="text-lg font-medium text-forest/60">{{ $order->quantity }} Units</span>
                                        </td>
                                        <td class="px-12 py-10">
                                            <span class="text-xl font-bold text-forest">₹{{ number_format($order->total_price, 0) }}</span>
                                        </td>
                                        <td class="px-12 py-10">
                                            @php
                                                $method = strtolower($order->payment_method ?? 'credit');
                                                $shortMethod = 'CREDIT';
                                                $badgeStyle = 'bg-forest text-sunlight border border-forest/10';
                                                
                                                if (str_contains($method, 'online') || str_contains($method, 'razorpay') || str_contains($method, 'simulated')) {
                                                    $shortMethod = 'ONLINE';
                                                    $badgeStyle = 'bg-forest text-sunlight border border-forest/10';
                                                } elseif (str_contains($method, 'cod') || str_contains($method, 'harvest') || str_contains($method, 'delivery') || str_contains($method, 'estate collection')) {
                                                    $shortMethod = 'COD';
                                                    $badgeStyle = 'bg-earth text-sunlight border border-earth/10';
                                                } elseif (str_contains($method, 'upi')) {
                                                    $shortMethod = 'UPI';
                                                    $badgeStyle = 'bg-forest/85 text-sunlight border border-forest/10';
                                                }
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-widest {{ $badgeStyle }} shadow-sm">
                                                {{ $shortMethod }}
                                            </span>
                                        </td>
                                        <td class="px-12 py-10 text-right">
                                            @php
                                                $statusLabel = 'Awaiting';
                                                $statusBadgeStyle = 'bg-forest/60 text-sunlight border border-forest/10';
                                                if ($order->status === 'confirmed') {
                                                    $statusLabel = 'Confirmed';
                                                    $statusBadgeStyle = 'bg-forest/80 text-sunlight border border-forest/10';
                                                } elseif ($order->status === 'dispatched') {
                                                    $statusLabel = 'Shipped';
                                                    $statusBadgeStyle = 'bg-forest text-sunlight border border-forest/10';
                                                } elseif ($order->status === 'delivered') {
                                                    $statusLabel = 'Arrived';
                                                    $statusBadgeStyle = 'bg-emerald-600 text-white border border-emerald-600/10';
                                                } elseif ($order->status === 'cancelled') {
                                                    $statusLabel = 'Cancelled';
                                                    $statusBadgeStyle = 'bg-red-700 text-white border border-red-700/10';
                                                }
                                            @endphp
                                            <span class="inline-flex items-center gap-1.5 text-[9px] font-black uppercase tracking-widest {{ $statusBadgeStyle }} px-3 py-1.5 rounded-full shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                    </tr>
                                    
                                    <!-- Shipment Progress Stepper Sub-Row -->
                                    <tr class="bg-forest/[0.01] border-b border-forest/5 pointer-events-none">
                                         <td colspan="6" class="px-12 pb-8 pt-0">
                                             @if($order->status === 'cancelled')
                                                 <div class="bg-red-600/5 rounded-2xl p-4 border border-red-600/10 flex items-center gap-3">
                                                     <div class="w-8 h-8 rounded-full bg-red-600/10 flex items-center justify-center text-red-600">
                                                         <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                     </div>
                                                     <div>
                                                         <p class="text-[9px] font-black uppercase tracking-wider text-red-600">Acquisition Terminated</p>
                                                         <p class="text-[8px] text-red-600/50 uppercase tracking-widest mt-0.5">This transaction has been cancelled</p>
                                                     </div>
                                                 </div>
                                             @else
                                                 @php
                                                     $step = 1;
                                                     if ($order->status === 'confirmed') $step = 2;
                                                     elseif ($order->status === 'dispatched') $step = 3;
                                                     elseif ($order->status === 'delivered') $step = 4;
                                                     
                                                     $progressWidth = '0%';
                                                     if ($step === 2) $progressWidth = '33.33%';
                                                     elseif ($step === 3) $progressWidth = '66.66%';
                                                     elseif ($step === 4) $progressWidth = '100%';
                                                 @endphp
                                                 <div class="max-w-4xl mx-auto pt-4 pb-2">
                                                     <div class="relative flex items-center justify-between">
                                                         <!-- Progress Connecting Lines -->
                                                         <div class="absolute left-4 right-4 top-4.5 h-[3px] bg-forest/5 rounded-full"></div>
                                                         <div class="absolute left-4 top-4.5 h-[3px] bg-earth rounded-full transition-all duration-700" style="width: calc({{ $progressWidth }} - 2rem); max-width: 100%;"></div>
                                                         
                                                         <!-- Step 1: Placed -->
                                                         <div class="relative z-10 flex flex-col items-center">
                                                             <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $step >= 1 ? 'bg-earth text-cream shadow-[0_0_12px_rgba(140,106,83,0.3)]' : 'bg-forest/5 text-forest/20' }} transition-colors duration-500">
                                                                 <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                                             </div>
                                                             <span class="text-[9px] font-black uppercase tracking-wider mt-2.5 {{ $step >= 1 ? 'text-forest font-bold' : 'text-forest/30' }}">Placed</span>
                                                             <span class="text-[7.5px] font-bold text-forest/40 uppercase tracking-widest mt-0.5">Order Received</span>
                                                         </div>
                                                         
                                                         <!-- Step 2: Confirmed -->
                                                         <div class="relative z-10 flex flex-col items-center">
                                                             <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $step >= 2 ? 'bg-earth text-cream shadow-[0_0_12px_rgba(140,106,83,0.3)]' : 'bg-forest/5 text-forest/20' }} transition-colors duration-500">
                                                                 <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                                             </div>
                                                             <span class="text-[9px] font-black uppercase tracking-wider mt-2.5 {{ $step >= 2 ? 'text-forest font-bold' : 'text-forest/30' }}">Ready</span>
                                                             <span class="text-[7.5px] font-bold text-forest/40 uppercase tracking-widest mt-0.5">Confirmed & Packed</span>
                                                         </div>

                                                         <!-- Step 3: Dispatched -->
                                                         <div class="relative z-10 flex flex-col items-center">
                                                             <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $step >= 3 ? 'bg-earth text-cream shadow-[0_0_12px_rgba(140,106,83,0.3)]' : 'bg-forest/5 text-forest/20' }} transition-colors duration-500">
                                                                 <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10M13 16h6m-6 0H6m13 0a2 2 0 002-2v-4a2 2 0 00-2-2h-3V6a1 1 0 00-1-1m0 11v-5h4"></path></svg>
                                                             </div>
                                                             <span class="text-[9px] font-black uppercase tracking-wider mt-2.5 {{ $step >= 3 ? 'text-forest font-bold' : 'text-forest/30' }}">Shipped</span>
                                                             <span class="text-[7.5px] font-bold text-forest/40 uppercase tracking-widest mt-0.5">In Transit</span>
                                                         </div>

                                                         <!-- Step 4: Delivered -->
                                                         <div class="relative z-10 flex flex-col items-center">
                                                             <div class="w-9 h-9 rounded-full flex items-center justify-center {{ $step >= 4 ? 'bg-emerald text-cream shadow-[0_0_12px_rgba(16,185,129,0.3)]' : 'bg-forest/5 text-forest/20' }} transition-colors duration-500">
                                                                 <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                             </div>
                                                             <span class="text-[9px] font-black uppercase tracking-wider mt-2.5 {{ $step >= 4 ? 'text-emerald font-bold' : 'text-forest/30' }}">Arrived</span>
                                                             <span class="text-[7.5px] font-bold text-forest/40 uppercase tracking-widest mt-0.5">Delivered</span>
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="px-12 py-32 text-center text-forest/20 italic font-medium text-lg">No recent manifests recorded in the ledger.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <!-- Supplier View -->
                @php 
                    $products = \App\Models\Product::with('reviews')->where('user_id', auth()->id())->latest()->take(5)->get(); 
                    $incomingOrders = \App\Models\Order::with(['product', 'user'])
                        ->whereHas('product', function($q) {
                            $q->where('user_id', auth()->id());
                        })
                        ->latest()
                        ->take(5)
                        ->get();
                @endphp

                <!-- Incoming Acquisitions Section -->
                <div class="mb-16">
                    <div class="flex items-center gap-6 mb-8">
                        <h4 class="font-heading text-3xl text-forest shrink-0">Incoming <span class="italic text-earth">Acquisitions</span></h4>
                        <div class="h-px w-full bg-forest/10"></div>
                    </div>
                    <div class="bg-white rounded-[3rem] border border-forest/5 overflow-hidden shadow-sm">
                        <div>
                            <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b border-forest/5">
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Order Info</th>
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Client</th>
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Volume</th>
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Valuation</th>
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Settlement</th>
                                            <th class="px-12 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Update Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-forest/5">
                                        @forelse($incomingOrders as $order)
                                            <tr class="group hover:bg-sage/10 transition-colors">
                                                <td class="px-12 py-6">
                                                    <span class="font-heading text-lg text-forest">{{ $order->product->name }}</span>
                                                </td>
                                                <td class="px-12 py-6">
                                                    <span class="text-xs font-medium text-forest/70">{{ $order->user->name }}</span>
                                                </td>
                                                <td class="px-12 py-6">
                                                    <span class="text-sm font-medium text-forest/60">{{ $order->quantity }} Units</span>
                                                </td>
                                                <td class="px-12 py-6">
                                                    <span class="text-base font-bold text-forest">₹{{ number_format($order->total_price, 0) }}</span>
                                                </td>
                                                <td class="px-12 py-6">
                                                    @php
                                                        $method = strtolower($order->payment_method ?? 'credit');
                                                        $shortMethod = 'CREDIT';
                                                        $badgeStyle = 'bg-forest text-sunlight border border-forest/10';
                                                        
                                                        if (str_contains($method, 'online') || str_contains($method, 'razorpay') || str_contains($method, 'simulated')) {
                                                            $shortMethod = 'ONLINE';
                                                            $badgeStyle = 'bg-forest text-sunlight border border-forest/10';
                                                        } elseif (str_contains($method, 'cod') || str_contains($method, 'harvest') || str_contains($method, 'delivery') || str_contains($method, 'estate collection')) {
                                                            $shortMethod = 'COD';
                                                            $badgeStyle = 'bg-earth text-sunlight border border-earth/10';
                                                        } elseif (str_contains($method, 'upi')) {
                                                            $shortMethod = 'UPI';
                                                            $badgeStyle = 'bg-forest/85 text-sunlight border border-forest/10';
                                                        }
                                                    @endphp
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[8px] font-black uppercase tracking-widest {{ $badgeStyle }} shadow-sm">
                                                        {{ $shortMethod }}
                                                    </span>
                                                </td>
                                                <td class="px-12 py-6">
                                                    <form action="{{ route('orders.update-status', $order) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="{{ $order->status }}">
                                                    </form>
                                                    @php
                                                        $statusOptions = [
                                                            'pending'    => ['label' => 'Awaiting',    'desc' => 'Pending confirmation',  'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                                                            'confirmed'  => ['label' => 'Confirmed',   'desc' => 'Ready to dispatch',     'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                                                            'dispatched' => ['label' => 'Shipped',     'desc' => 'In transit now',        'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0'],
                                                            'delivered'  => ['label' => 'Delivered',   'desc' => 'Successfully arrived',  'icon' => 'M5 13l4 4L19 7'],
                                                            'cancelled'  => ['label' => 'Cancelled',   'desc' => 'Order terminated',      'icon' => 'M6 18L18 6M6 6l12 12'],
                                                        ];
                                                        $currentOpt = $statusOptions[$order->status] ?? $statusOptions['pending'];
                                                    @endphp
                                                    <div class="terra-dropdown" data-order-id="{{ $order->id }}">
                                                        <button type="button" class="terra-dropdown__trigger" onclick="terraToggleDropdown(this)">
                                                            <span class="terra-dropdown__dot terra-dropdown__dot--{{ $order->status }}"></span>
                                                            <span class="terra-dropdown__label">{{ $currentOpt['label'] }}</span>
                                                            <svg class="terra-dropdown__chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
                                                        </button>
                                                        <div class="terra-dropdown__panel">
                                                            <div class="terra-dropdown__panel-inner">
                                                                @foreach($statusOptions as $value => $opt)
                                                                <button type="button"
                                                                    class="terra-dropdown__option {{ $order->status === $value ? 'terra-dropdown__option--active' : '' }}"
                                                                    data-value="{{ $value }}"
                                                                    onclick="terraSelectOption(this, '{{ $value }}', {{ $order->id }})">
                                                                    <span class="terra-dropdown__opt-icon terra-dropdown__opt-icon--{{ $value }}">
                                                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $opt['icon'] }}"/></svg>
                                                                    </span>
                                                                    <span class="terra-dropdown__opt-text">
                                                                        <span class="terra-dropdown__opt-label">{{ $opt['label'] }}</span>
                                                                        <span class="terra-dropdown__opt-desc">{{ $opt['desc'] }}</span>
                                                                    </span>
                                                                    @if($order->status === $value)
                                                                    <svg class="terra-dropdown__check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>
                                                                    @endif
                                                                </button>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="px-12 py-16 text-center text-forest/20 italic font-medium">No incoming orders recorded yet.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <!-- Listed Inventory Section -->
                <div class="mb-16">
                    <div class="flex items-center gap-6 mb-8">
                        <h4 class="font-heading text-3xl text-forest shrink-0">Listed <span class="italic text-earth">Inventory</span></h4>
                        <div class="h-px w-full bg-forest/10"></div>
                    </div>
                    <div class="bg-white rounded-[3rem] border border-forest/5 overflow-hidden shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="border-b border-forest/5">
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Product</th>
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Rating</th>
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Stock</th>
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Price</th>
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Status</th>
                                            <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30 text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-forest/5">
                                        @forelse($products as $product)
                                            @php
                                                $image_map = [
                                                    'sprayer' => asset('images/products/sprayer.png'),
                                                    'seeder' => asset('images/products/seeder.png'),
                                                    'rake' => asset('images/products/rake.png'),
                                                    'pickaxe' => asset('images/products/pickaxe.png'),
                                                    'spade' => asset('images/products/sprayer.png'),
                                                ];
                        
                                                $name = strtolower($product->name);
                                                $imgSrc = null;
                                                foreach ($image_map as $key => $url) {
                                                    if (str_contains($name, $key)) {
                                                        $imgSrc = $url;
                                                        break;
                                                    }
                                                }
                        
                                                if (!$imgSrc) {
                                                    $imgSrc = str_starts_with($product->image_url ?? '', '/')
                                                        ? asset($product->image_url)
                                                        : ($product->image_url ?? 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=200');
                                                }
                                            @endphp
                                            <tr class="group hover:bg-sage/10 transition-colors cursor-pointer" onclick="window.location='{{ route('products.show', $product) }}'">
                                                <td class="px-12 py-10">
                                                    <a href="{{ route('products.show', $product) }}" class="flex items-center gap-4">
                                                        <div class="w-14 h-14 rounded-2xl overflow-hidden bg-forest/5 flex-shrink-0 border border-forest/5">
                                                            <img src="{{ $imgSrc }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                        </div>
                                                        <div>
                                                            <span class="font-heading text-2xl text-forest group-hover:text-earth transition-colors">{{ $product->name }}</span>
                                                            <p class="text-[9px] font-bold text-forest/30 uppercase tracking-[0.2em] mt-1">{{ $product->category }}</p>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="px-12 py-10">
                                                    <div class="flex flex-col gap-1">
                                                        <div class="flex items-center gap-2">
                                                            <div class="flex text-gold">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    <svg class="w-3 h-3 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                                    </svg>
                                                                @endfor
                                                            </div>
                                                            <span class="text-sm font-bold text-forest">{{ number_format($product->average_rating, 1) }}</span>
                                                        </div>
                                                        <span class="text-[9px] font-bold text-forest/30 uppercase tracking-widest">{{ $product->review_count }} Reviews</span>
                                                    </div>
                                                </td>
                                                <td class="px-12 py-10 font-medium text-forest/60">{{ $product->stock_quantity }} Available</td>
                                                <td class="px-12 py-10 font-bold text-forest text-xl">₹{{ number_format($product->price, 0) }}</td>
                                                <td class="px-12 py-10">
                                                    <span class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-earth bg-earth/10 px-4 py-1.5 rounded-full">
                                                        ACTIVE
                                                    </span>
                                                </td>
                                                <td class="px-12 py-10 text-right">
                                                    <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-2 bg-forest text-gold px-6 py-3 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-gold hover:text-forest transition-all shadow-md">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="6" class="px-12 py-32 text-center text-forest/20 italic font-medium text-lg">Your inventory is currently empty.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
    </div>

    <style>
        .font-heading { font-family: 'Fraunces', serif; }

        /* ═══════════════════════════════════════════════
           TERRA MARKET — Premium Status Dropdown
           ═══════════════════════════════════════════════ */
        .terra-dropdown {
            position: relative;
            display: inline-block;
            z-index: 20;
        }
        .terra-dropdown.is-open { z-index: 50; }

        /* ── Trigger Button ── */
        .terra-dropdown__trigger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px 8px 12px;
            border-radius: 999px;
            border: none;
            background: #1C3F2B;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            outline: none;
            box-shadow: 0 2px 8px rgba(28, 63, 43, 0.25);
        }
        .terra-dropdown__trigger:hover {
            background: #255339;
            box-shadow: 0 4px 16px rgba(28, 63, 43, 0.35);
            transform: translateY(-1px);
        }
        .terra-dropdown.is-open .terra-dropdown__trigger {
            background: #255339;
            box-shadow: 0 4px 20px rgba(28, 63, 43, 0.4);
            transform: translateY(-1px);
        }

        .terra-dropdown__label {
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: #ffffff;
        }

        .terra-dropdown__chevron {
            color: rgba(255, 255, 255, 0.6);
            transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            flex-shrink: 0;
        }
        .terra-dropdown.is-open .terra-dropdown__chevron {
            transform: rotate(180deg);
        }

        /* ── Status Dot (Trigger) ── */
        .terra-dropdown__dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
        }
        .terra-dropdown__dot::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            opacity: 0.35;
        }
        .terra-dropdown__dot--pending    { background: #fbbf24; box-shadow: 0 0 6px rgba(251,191,36,0.6); }
        .terra-dropdown__dot--pending::after  { background: #fbbf24; }
        .terra-dropdown__dot--confirmed  { background: #2563eb; box-shadow: 0 0 8px rgba(37, 99, 235, 0.4); }
        .terra-dropdown__dot--confirmed::after { background: #2563eb; }
        .terra-dropdown__dot--dispatched { background: #7c3aed; box-shadow: 0 0 8px rgba(124, 58, 237, 0.4); }
        .terra-dropdown__dot--dispatched::after { background: #7c3aed; }
        .terra-dropdown__dot--delivered  { background: #059669; box-shadow: 0 0 8px rgba(5, 150, 105, 0.4); }
        .terra-dropdown__dot--delivered::after  { background: #059669; }
        .terra-dropdown__dot--cancelled  { background: #dc2626; box-shadow: 0 0 8px rgba(220, 38, 38, 0.4); }
        .terra-dropdown__dot--cancelled::after  { background: #dc2626; }

        /* ── Dropdown Panel ── */
        .terra-dropdown__panel {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 260px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.96);
            transform-origin: top right;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }
        .terra-dropdown.is-open .terra-dropdown__panel {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .terra-dropdown__panel-inner {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(30, 43, 33, 0.08);
            border-radius: 20px;
            padding: 6px;
            box-shadow:
                0 20px 60px rgba(30, 43, 33, 0.12),
                0 8px 24px rgba(30, 43, 33, 0.06),
                0 0 0 1px rgba(255, 255, 255, 0.6) inset;
            overflow: hidden;
        }

        /* ── Option Items ── */
        .terra-dropdown__option {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 10px 14px;
            border: none;
            border-radius: 14px;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: inherit;
            text-align: left;
            position: relative;
            overflow: hidden;
        }
        .terra-dropdown__option::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 14px;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .terra-dropdown__option:hover {
            transform: translateX(2px);
        }
        .terra-dropdown__option:hover::before {
            opacity: 1;
        }
        .terra-dropdown__option:active {
            transform: scale(0.98) translateX(2px);
        }
        .terra-dropdown__option--active {
            background: rgba(30, 43, 33, 0.04);
        }

        /* Hover Tints per Status */
        .terra-dropdown__option[data-value="pending"]:hover::before    { background: rgba(217, 119, 6, 0.06); }
        .terra-dropdown__option[data-value="confirmed"]:hover::before  { background: rgba(37, 99, 235, 0.06); }
        .terra-dropdown__option[data-value="dispatched"]:hover::before { background: rgba(124, 58, 237, 0.06); }
        .terra-dropdown__option[data-value="delivered"]:hover::before  { background: rgba(5, 150, 105, 0.06); }
        .terra-dropdown__option[data-value="cancelled"]:hover::before  { background: rgba(220, 38, 38, 0.06); }

        /* ── Option Icon ── */
        .terra-dropdown__opt-icon {
            width: 32px;
            height: 32px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }
        .terra-dropdown__opt-icon--pending    { background: rgba(217, 119, 6, 0.1);  color: #d97706; }
        .terra-dropdown__opt-icon--confirmed  { background: rgba(37, 99, 235, 0.1);  color: #2563eb; }
        .terra-dropdown__opt-icon--dispatched { background: rgba(124, 58, 237, 0.1); color: #7c3aed; }
        .terra-dropdown__opt-icon--delivered  { background: rgba(5, 150, 105, 0.1);  color: #059669; }
        .terra-dropdown__opt-icon--cancelled  { background: rgba(220, 38, 38, 0.1);  color: #dc2626; }

        .terra-dropdown__option:hover .terra-dropdown__opt-icon--pending    { background: rgba(217, 119, 6, 0.18);  box-shadow: 0 0 12px rgba(217, 119, 6, 0.15); }
        .terra-dropdown__option:hover .terra-dropdown__opt-icon--confirmed  { background: rgba(37, 99, 235, 0.18);  box-shadow: 0 0 12px rgba(37, 99, 235, 0.15); }
        .terra-dropdown__option:hover .terra-dropdown__opt-icon--dispatched { background: rgba(124, 58, 237, 0.18); box-shadow: 0 0 12px rgba(124, 58, 237, 0.15); }
        .terra-dropdown__option:hover .terra-dropdown__opt-icon--delivered  { background: rgba(5, 150, 105, 0.18);  box-shadow: 0 0 12px rgba(5, 150, 105, 0.15); }
        .terra-dropdown__option:hover .terra-dropdown__opt-icon--cancelled  { background: rgba(220, 38, 38, 0.18);  box-shadow: 0 0 12px rgba(220, 38, 38, 0.15); }

        /* ── Option Text ── */
        .terra-dropdown__opt-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
            flex: 1;
            min-width: 0;
        }
        .terra-dropdown__opt-label {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: rgba(30, 43, 33, 0.8);
            line-height: 1.4;
        }
        .terra-dropdown__opt-desc {
            font-size: 9px;
            font-weight: 600;
            color: rgba(30, 43, 33, 0.35);
            letter-spacing: 0.04em;
            line-height: 1.3;
        }

        /* ── Checkmark ── */
        .terra-dropdown__check {
            color: rgba(30, 43, 33, 0.4);
            flex-shrink: 0;
            animation: terraCheckPop 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        /* ── Backdrop Overlay ── */
        .terra-dropdown-backdrop {
            position: fixed;
            inset: 0;
            z-index: 40;
            background: transparent;
        }

        /* ── Animations ── */
        @keyframes terraCheckPop {
            0%   { transform: scale(0); opacity: 0; }
            60%  { transform: scale(1.2); }
            100% { transform: scale(1); opacity: 1; }
        }

        /* ── Separator between options ── */
        .terra-dropdown__option + .terra-dropdown__option {
            margin-top: 2px;
        }
        .terra-dropdown__option[data-value="cancelled"] {
            margin-top: 6px;
            position: relative;
        }
        .terra-dropdown__option[data-value="cancelled"]::after {
            content: '';
            position: absolute;
            top: -4px;
            left: 14px;
            right: 14px;
            height: 1px;
            background: rgba(30, 43, 33, 0.06);
        }
    </style>

    <script>
        // ═══════════════════════════════════════════
        // TERRA MARKET — Custom Dropdown Controller
        // ═══════════════════════════════════════════

        function terraToggleDropdown(triggerEl) {
            const dropdown = triggerEl.closest('.terra-dropdown');
            const isOpen = dropdown.classList.contains('is-open');

            // Close all other open dropdowns first
            document.querySelectorAll('.terra-dropdown.is-open').forEach(d => {
                if (d !== dropdown) d.classList.remove('is-open');
            });

            // Remove existing backdrop
            document.querySelectorAll('.terra-dropdown-backdrop').forEach(b => b.remove());

            if (!isOpen) {
                dropdown.classList.add('is-open');

                // Create invisible backdrop for click-outside-to-close
                const backdrop = document.createElement('div');
                backdrop.className = 'terra-dropdown-backdrop';
                backdrop.addEventListener('click', () => {
                    dropdown.classList.remove('is-open');
                    backdrop.remove();
                });
                document.body.appendChild(backdrop);
            } else {
                dropdown.classList.remove('is-open');
            }
        }

        function terraSelectOption(optionEl, value, orderId) {
            const dropdown = optionEl.closest('.terra-dropdown');
            const form = dropdown.previousElementSibling;
            const hiddenInput = form.querySelector('input[name="status"]');

            // Update hidden input and submit
            hiddenInput.value = value;

            // Visual feedback — briefly flash the option
            optionEl.style.transition = 'background 0.15s ease';
            optionEl.style.background = 'rgba(30, 43, 33, 0.08)';

            setTimeout(() => {
                // Close dropdown
                dropdown.classList.remove('is-open');
                document.querySelectorAll('.terra-dropdown-backdrop').forEach(b => b.remove());

                // Submit form
                form.submit();
            }, 180);
        }

        // Close on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('.terra-dropdown.is-open').forEach(d => d.classList.remove('is-open'));
                document.querySelectorAll('.terra-dropdown-backdrop').forEach(b => b.remove());
            }
        });
    </script>
</x-app-layout>
