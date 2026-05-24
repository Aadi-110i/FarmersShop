<x-app-layout>
    <x-slot name="header">
        Broadcasting Hub
    </x-slot>

    <div class="max-w-6xl px-4 lg:px-8 mx-auto space-y-12 py-4">
        <!-- Toast Notification Error -->
        @if(session('error'))
            <div class="bg-red-50/80 backdrop-blur-md border border-red-200 text-red-700 p-4 rounded-2xl flex items-center justify-between shadow-xl shadow-red-900/5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] opacity-60">System Alert</p>
                        <p class="text-xs font-bold">{{ session('error') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        @if(auth()->user()->role === 'farmer')
            <!-- FARMER VIEW: COMPOSER & FEED -->
            <div class="flex flex-col xl:flex-row gap-10 items-start">
                <!-- THE COMPOSER -->
                <div class="w-full xl:w-1/2 bg-forest p-8 md:p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden group shrink-0 sticky top-4">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-earth/10 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
                    
                    <div class="relative z-10 flex flex-col gap-8">
                        <!-- Top/Left Side: Branding/Title -->
                        <div class="border-b border-sunlight/10 pb-6">
                            <div class="sticky top-0">
                                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sunlight/5 border border-sunlight/10 mb-4">
                                    <span class="w-1 h-1 rounded-full bg-emerald animate-pulse"></span>
                                    <span class="text-[8px] font-black text-sunlight/60 uppercase tracking-widest">Network Live</span>
                                </span>
                                <h3 class="font-heading text-4xl text-sunlight leading-tight mb-4">Broadcast a <span class="italic text-gold text-nowrap">Need.</span></h3>
                                <p class="text-sage/40 text-[10px] font-medium uppercase tracking-[0.15em] leading-relaxed">
                                    Emit a high-priority signal to all local suppliers in the agricultural nexus.
                                </p>
                            </div>
                        </div>

                        <!-- Bottom/Right Side: The Form -->
                        <div>
                            <form method="POST" action="{{ route('farmer-requests.store') }}" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Item Name -->
                                    <div class="space-y-1.5">
                                        <label for="product_name" class="text-[9px] font-black uppercase tracking-[0.2em] text-sunlight/40 ml-1">Provision Name</label>
                                        <input id="product_name" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="e.g. Hybrid Seeds" required
                                            class="block w-full bg-sunlight/5 border border-sunlight/10 focus:border-gold/30 focus:ring-0 rounded-xl py-3 px-4 text-xs font-bold text-sunlight transition-all placeholder:text-sunlight/20" />
                                        <x-input-error :messages="$errors->get('product_name')" class="mt-1" />
                                    </div>

                                    <!-- Quantity -->
                                    <div class="space-y-1.5">
                                        <label for="quantity" class="text-[9px] font-black uppercase tracking-[0.2em] text-sunlight/40 ml-1">Volume</label>
                                        <input id="quantity" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 50 kg" required
                                            class="block w-full bg-sunlight/5 border border-sunlight/10 focus:border-gold/30 focus:ring-0 rounded-xl py-3 px-4 text-xs font-bold text-sunlight transition-all placeholder:text-sunlight/20" />
                                        <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <!-- Urgency -->
                                    <div class="space-y-1.5">
                                        <label class="text-[9px] font-black uppercase tracking-[0.2em] text-sunlight/40 ml-1">Urgency</label>
                                        <div class="grid grid-cols-3 gap-2">
                                            @foreach(['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $val => $label)
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="urgency" value="{{ $val }}" class="sr-only peer" {{ ($val === 'medium' || old('urgency') === $val) ? 'checked' : '' }}>
                                                    <div class="py-2.5 rounded-xl border border-sunlight/10 bg-sunlight/5 text-white/60 text-center font-black text-[10px] uppercase tracking-widest transition-all peer-checked:bg-gold peer-checked:text-white peer-checked:border-gold hover:bg-sunlight/10 flex items-center justify-center gap-1.5 active:scale-95">
                                                        <span>{{ $label }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        <x-input-error :messages="$errors->get('urgency')" class="mt-1" />
                                    </div>

                                    <!-- Notes -->
                                    <div class="space-y-1.5">
                                        <label for="notes" class="text-[9px] font-black uppercase tracking-[0.2em] text-sunlight/40 ml-1">Specs (Optional)</label>
                                        <input id="notes" name="notes" value="{{ old('notes') }}" placeholder="e.g. Soil requirements..."
                                            class="block w-full bg-sunlight/5 border border-sunlight/10 focus:border-gold/30 focus:ring-0 rounded-xl py-3 px-4 text-xs font-medium text-sunlight transition-all placeholder:text-sunlight/20" />
                                        <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-gold text-forest py-4 rounded-xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-sunlight hover:shadow-2xl hover:shadow-gold/20 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 transition-all shadow-lg flex items-center justify-center gap-2 group/btn">
                                    <span>Initiate Signal</span>
                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- THE FEED -->
                <div class="w-full xl:w-1/2 space-y-6">
                    <div class="flex items-center gap-4 px-2">
                        <h3 class="font-heading text-2xl text-forest shrink-0">Your <span class="italic text-earth">Activity Feed</span></h3>
                        <div class="h-px w-full bg-forest/10"></div>
                        <span class="text-[9px] font-black text-forest/30 uppercase tracking-[0.2em] text-nowrap">History & Status</span>
                    </div>

                    <div class="space-y-4">
                        @forelse($farmerRequests as $request)
                            <div class="bg-white p-6 rounded-3xl border border-forest/5 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden group">
                                @if($request->status === 'pending')
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-amber-400"></div>
                                @else
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-emerald"></div>
                                @endif

                                <div class="flex items-start gap-6">
                                    <div class="w-12 h-12 rounded-2xl {{ $request->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-emerald/10 text-emerald' }} flex items-center justify-center shrink-0">
                                        @if($request->status === 'pending')
                                            <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-3 mb-1">
                                            <h4 class="font-heading text-xl text-forest">{{ $request->product_name }}</h4>
                                            @if($request->urgency === 'high')
                                                <span class="px-2 py-0.5 rounded-md bg-red-50 text-red-600 text-[8px] font-black uppercase tracking-widest border border-red-100">Critical</span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] font-bold text-forest/40 uppercase tracking-widest">
                                            Volume: <span class="text-earth">{{ $request->quantity }}</span> 
                                            <span class="mx-2 opacity-20">•</span> 
                                            Signal Latency: <span class="text-forest/60">{{ $request->created_at->diffForHumans() }}</span>
                                        </p>
                                        @if($request->notes)
                                            <p class="text-xs text-forest/60 mt-2 italic font-medium">"{{ $request->notes }}"</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 shrink-0 border-t md:border-t-0 pt-4 md:pt-0">
                                    @if($request->status === 'pending')
                                        <div class="text-right hidden md:block">
                                            <span class="text-[9px] font-black text-amber-500 uppercase tracking-widest block mb-1">Status: Open</span>
                                            <span class="text-[10px] font-bold text-forest/30">Seeking Supplier</span>
                                        </div>
                                        <form method="POST" action="{{ route('farmer-requests.destroy', $request) }}" onsubmit="return confirm('Retract this signal?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-10 h-10 flex items-center justify-center text-forest/20 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex items-center gap-3 bg-emerald/5 px-4 py-2 rounded-2xl border border-emerald/10">
                                            <div class="text-right">
                                                <span class="text-[8px] font-black text-emerald uppercase tracking-widest block leading-none mb-1">Fulfilled by</span>
                                                <span class="text-[11px] font-black text-forest">The Supplier</span>
                                            </div>
                                            <div class="w-8 h-8 rounded-full bg-forest text-gold flex items-center justify-center text-[10px] font-black">
                                                S
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="py-20 px-6 rounded-3xl border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                                <div class="w-16 h-16 rounded-full bg-sage/20 flex items-center justify-center text-3xl mb-4 text-forest/40">📡</div>
                                <h4 class="font-heading text-xl text-forest mb-2">No signals emitted</h4>
                                <p class="text-xs text-forest/40 font-medium max-w-xs leading-relaxed">Your broadcast history is empty. Use the composer above to start.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        @else
            <!-- SUPPLIER VIEW: RADAR & STREAM -->
            <div class="space-y-12">
                <!-- THE RADAR HEADER -->
                <div class="bg-forest p-10 md:p-14 rounded-[3rem] shadow-2xl relative overflow-hidden text-center">
                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, #FDF9EC 1px, transparent 0); background-size: 32px 32px;"></div>
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-gold/5 rounded-full blur-[100px] -translate-y-1/2"></div>
                    
                    <div class="relative z-10">
                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-sunlight/10 backdrop-blur-md text-gold text-[9px] font-black uppercase tracking-[0.3em] mb-6 border border-sunlight/10">
                            <span class="w-2 h-2 bg-emerald rounded-full animate-pulse"></span>
                            Demand Nexus Monitoring
                        </span>
                        <h3 class="font-heading text-5xl text-sunlight mb-4">Signal <span class="italic text-gold">Nexus.</span></h3>
                        <p class="text-sage/60 font-medium text-lg leading-relaxed max-w-xl mx-auto">
                            Intercept and fulfill live agricultural demands from verified farmers across the network.
                        </p>
                    </div>
                </div>

                <!-- THE DEMAND STREAM -->
                <div class="space-y-8">
                    <div class="flex items-center gap-4 px-2">
                        <h3 class="font-heading text-2xl text-forest shrink-0">Live <span class="italic text-earth">Demands</span></h3>
                        <div class="h-px w-full bg-forest/10"></div>
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                            <span class="text-[9px] font-black text-forest/30 uppercase tracking-[0.2em] text-nowrap">Real-time Stream</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        @forelse($farmerRequests as $request)
                            <div class="bg-white p-8 rounded-[2rem] border border-forest/5 shadow-sm hover:shadow-xl hover:translate-x-1 transition-all duration-500 group">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                                    <div class="flex items-start gap-8 flex-grow">
                                        <!-- Farmer Avatar & Identity -->
                                        <div class="relative shrink-0">
                                            <div class="w-16 h-16 rounded-3xl bg-forest flex items-center justify-center font-black text-xl text-gold shadow-xl rotate-3 group-hover:rotate-0 transition-transform">
                                                {{ strtoupper(substr($request->user->name, 0, 2)) }}
                                            </div>
                                            <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-sunlight border-4 border-white flex items-center justify-center text-[10px]">🚜</div>
                                        </div>

                                        <div class="space-y-3">
                                            <div class="flex items-center gap-4">
                                                <h4 class="font-heading text-3xl text-forest leading-none">{{ $request->product_name }}</h4>
                                                @if($request->urgency === 'high')
                                                    <span class="px-3 py-1 rounded-full bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-widest border border-red-100 flex items-center gap-1.5">
                                                        <span class="animate-ping w-1 h-1 rounded-full bg-red-600"></span>
                                                        Immediate
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] font-black text-forest/20 uppercase tracking-widest">Target Volume:</span>
                                                    <span class="text-sm font-black text-earth">{{ $request->quantity }}</span>
                                                </div>
                                                <div class="flex items-center gap-2 border-l border-forest/10 pl-6">
                                                    <span class="text-[9px] font-black text-forest/20 uppercase tracking-widest">Initiated by:</span>
                                                    <span class="text-sm font-black text-forest/60">{{ $request->user->name }}</span>
                                                </div>
                                                <div class="flex items-center gap-2 border-l border-forest/10 pl-6">
                                                    <span class="text-[9px] font-black text-forest/20 uppercase tracking-widest">Elapsed:</span>
                                                    <span class="text-sm font-black text-forest/40 italic">{{ $request->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>

                                            @if($request->notes)
                                                <div class="bg-sage/5 p-4 rounded-2xl border border-forest/5 relative">
                                                    <p class="text-xs text-forest/60 font-medium italic leading-relaxed">
                                                        "{{ $request->notes }}"
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Action -->
                                    <div class="shrink-0 flex items-center justify-end">
                                        @if($request->status === 'pending')
                                            <form method="POST" action="{{ route('farmer-requests.fulfill', $request) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-forest text-gold px-10 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] hover:bg-gold hover:text-forest hover:shadow-2xl hover:shadow-gold/20 hover:-translate-y-1 active:translate-y-0 active:scale-95 transition-all shadow-xl group/btn flex items-center gap-3">
                                                    <span>Fulfill Need</span>
                                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center gap-4 bg-emerald/10 px-6 py-3 rounded-2xl border border-emerald/20 opacity-60">
                                                <svg class="w-5 h-5 text-emerald" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <div class="text-right">
                                                    <span class="text-[9px] font-black text-emerald uppercase tracking-widest block leading-none mb-1">Fulfilled</span>
                                                    <span class="text-[11px] font-black text-forest">The Supplier</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="py-40 px-6 rounded-[3rem] border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                                <div class="w-24 h-24 rounded-full bg-sage/20 flex items-center justify-center text-5xl mb-8">📡</div>
                                <h4 class="font-heading text-3xl text-forest mb-4">Radar Clear</h4>
                                <p class="text-base text-forest/40 font-medium max-w-sm leading-relaxed">The demand nexus is currently silent. Active requests will propagate here in real-time.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif

    </div>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }
    </style>
</x-app-layout>
