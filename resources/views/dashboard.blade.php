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
                <h3 class="font-heading text-4xl text-forest shrink-0">Recent <span class="italic text-earth">Manifest</span></h3>
                <div class="h-px w-full bg-forest/10"></div>
                <a href="#" class="shrink-0 text-[10px] font-bold text-forest/40 uppercase tracking-widest hover:text-earth transition-colors">View All</a>
            </div>
            
            <div class="bg-white rounded-[3.5rem] border border-forest/5 overflow-hidden shadow-sm">
                @if(auth()->user()->role === 'farmer')
                    @php $orders = \App\Models\Order::with('product')->where('user_id', auth()->id())->latest()->take(5)->get(); @endphp
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-forest/5">
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Provision</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Volume</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Valuation</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Method</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30 text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-forest/5">
                                @forelse($orders as $order)
                                    <tr class="group hover:bg-sage/10 transition-colors">
                                        <td class="px-12 py-10">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-2xl bg-forest/5 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🌱</div>
                                                <span class="font-heading text-2xl text-forest">{{ $order->product->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-12 py-10">
                                            <span class="text-lg font-medium text-forest/60">{{ $order->quantity }} Units</span>
                                        </td>
                                        <td class="px-12 py-10">
                                            <span class="text-xl font-bold text-forest">₹{{ number_format($order->total_price, 0) }}</span>
                                        </td>
                                        <td class="px-12 py-10">
                                            <span class="inline-block px-4 py-1.5 rounded-full bg-forest text-[10px] font-bold uppercase tracking-widest text-sunlight">
                                                {{ $order->payment_method ?? 'CREDIT' }}
                                            </span>
                                        </td>
                                        <td class="px-12 py-10 text-right">
                                            <span class="inline-flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-emerald bg-emerald/10 px-4 py-1.5 rounded-full">
                                                <span class="w-1.5 h-1.5 bg-emerald rounded-full"></span>
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-12 py-32 text-center text-forest/20 italic font-medium text-lg">No recent manifests recorded in the ledger.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Supplier View -->
                    @php $products = \App\Models\Product::where('user_id', auth()->id())->latest()->take(5)->get(); @endphp
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-forest/5">
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Product</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Stock</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Price</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30">Status</th>
                                    <th class="px-12 py-10 text-[10px] font-bold uppercase tracking-[0.2em] text-forest/30 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-forest/5">
                                @forelse($products as $product)
                                    <tr class="group hover:bg-sage/10 transition-colors">
                                        <td class="px-12 py-10">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-2xl bg-forest/5 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🚜</div>
                                                <span class="font-heading text-2xl text-forest">{{ $product->name }}</span>
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
                                            <a href="{{ route('products.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-forest/40 hover:text-earth">Manage</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-12 py-32 text-center text-forest/20 italic font-medium text-lg">Your inventory is currently empty.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .font-heading { font-family: 'Fraunces', serif; }
    </style>
</x-app-layout>
