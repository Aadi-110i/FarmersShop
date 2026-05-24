<x-app-layout>
    <x-slot name="header">
        Broadcasting Hub
    </x-slot>

    <div class="space-y-16 py-8">
        <!-- Toast Notification Error -->
        @if(session('error'))
            <div class="bg-red-50/80 backdrop-blur-md border border-red-200 text-red-700 p-6 rounded-[2.5rem] flex items-center justify-between shadow-xl shadow-red-900/5 max-w-4xl mx-auto">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-60">System Alert</p>
                        <p class="text-sm font-bold">{{ session('error') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        @if(auth()->user()->role === 'farmer')
            <!-- FARMER VIEW -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                
                <!-- Broadcast Form Card -->
                <div class="lg:col-span-5 sticky top-8">
                    <div class="bg-white p-10 md:p-12 rounded-[3.5rem] border border-forest/5 shadow-2xl shadow-forest/5 relative overflow-hidden group">
                        <!-- Decorative element -->
                        <div class="absolute -top-24 -right-24 w-48 h-48 bg-sage/20 rounded-full blur-3xl group-hover:bg-sage/30 transition-colors duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="mb-10">
                                <span class="inline-block px-4 py-1.5 rounded-full bg-sage/30 text-forest text-[9px] font-bold uppercase tracking-[0.25em] mb-4">Live Broadcast Engine</span>
                                <h3 class="font-heading text-4xl text-forest leading-tight">What do you <br><span class="italic text-earth">need today?</span></h3>
                                <p class="text-sm text-gray-500 mt-4 leading-relaxed font-medium">Instantly notify local suppliers about your immediate agricultural requirements.</p>
                            </div>

                            <form method="POST" action="{{ route('farmer-requests.store') }}" class="space-y-8">
                                @csrf

                                <!-- Item Name -->
                                <div class="space-y-2">
                                    <label for="product_name" class="text-[10px] font-black uppercase tracking-[0.2em] text-forest/40 ml-1">Provision Name</label>
                                    <div class="relative">
                                        <input id="product_name" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="e.g. Hybrid Basmati Seeds" required
                                            class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-2xl py-4 px-5 text-sm font-bold text-forest transition-all placeholder:text-forest/20 placeholder:font-normal" />
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-forest/20">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                                </div>

                                <!-- Quantity -->
                                <div class="space-y-2">
                                    <label for="quantity" class="text-[10px] font-black uppercase tracking-[0.2em] text-forest/40 ml-1">Required Volume</label>
                                    <div class="relative">
                                        <input id="quantity" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 50 kg or 10 Bags" required
                                            class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-2xl py-4 px-5 text-sm font-bold text-forest transition-all placeholder:text-forest/20 placeholder:font-normal" />
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-forest/20">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                </div>

                                <!-- Urgency Selector -->
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-forest/40 ml-1">Urgency Level</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        @foreach(['low' => '🍃 Low', 'medium' => '⚡ Mid', 'high' => '🚨 High'] as $val => $label)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="urgency" value="{{ $val }}" class="sr-only peer" {{ ($val === 'medium' || old('urgency') === $val) ? 'checked' : '' }}>
                                                <div class="py-3.5 px-2 rounded-2xl border-2 border-forest/5 bg-sage/5 text-forest/40 text-center font-black text-[9px] uppercase tracking-widest transition-all peer-checked:bg-forest peer-checked:text-sunlight peer-checked:border-forest hover:bg-sage/10 flex flex-col items-center gap-1.5 shadow-sm active:scale-95">
                                                    {{ $label }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('urgency')" class="mt-2" />
                                </div>

                                <!-- Notes -->
                                <div class="space-y-2">
                                    <label for="notes" class="text-[10px] font-black uppercase tracking-[0.2em] text-forest/40 ml-1">Specifications</label>
                                    <textarea id="notes" name="notes" rows="4" 
                                        class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-3xl py-4 px-5 text-sm font-medium text-forest transition-all placeholder:text-forest/20"
                                        placeholder="Describe soil requirements, brand preferences, or timing...">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                                </div>

                                <button type="submit" class="w-full bg-forest text-gold py-5 rounded-full font-black text-xs uppercase tracking-[0.3em] hover:bg-forest/95 hover:shadow-2xl hover:shadow-forest/20 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 transition-all shadow-xl shadow-forest/10 flex items-center justify-center gap-3">
                                    <span>Initiate Broadcast</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Your Active Needs Grid -->
                <div class="lg:col-span-7 space-y-12">
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-6">
                            <h3 class="font-heading text-5xl text-forest shrink-0">Active <span class="italic text-earth">Broadcasts</span></h3>
                            <div class="h-px w-full bg-forest/10"></div>
                        </div>
                        <p class="text-sm font-medium text-forest/40 uppercase tracking-widest ml-1">Real-time status of your marketplace demands</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @forelse($farmerRequests as $request)
                            <div class="bg-white/60 backdrop-blur-xl p-10 rounded-[3rem] border border-forest/5 shadow-xl shadow-forest/[0.02] hover:shadow-2xl hover:shadow-forest/5 transition-all duration-500 relative overflow-hidden group flex flex-col min-h-[320px]">
                                
                                <!-- Background Pulse -->
                                @if($request->status === 'pending')
                                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-400/5 rounded-full blur-2xl animate-pulse"></div>
                                @endif

                                <div class="relative z-10 flex flex-col flex-grow">
                                    <!-- Card Header -->
                                    <div class="flex items-center justify-between mb-8">
                                        <div class="flex items-center gap-2">
                                            @if($request->urgency === 'high')
                                                <div class="w-2 h-2 rounded-full bg-red-600 animate-ping"></div>
                                                <span class="text-[8px] font-black text-red-600 uppercase tracking-widest">Immediate Response Needed</span>
                                            @elseif($request->urgency === 'medium')
                                                <div class="w-2 h-2 rounded-full bg-earth"></div>
                                                <span class="text-[8px] font-black text-earth uppercase tracking-widest">Mid Priority Need</span>
                                            @else
                                                <div class="w-2 h-2 rounded-full bg-emerald"></div>
                                                <span class="text-[8px] font-black text-emerald uppercase tracking-widest">Standard Broadcast</span>
                                            @endif
                                        </div>
                                        <span class="text-[9px] font-bold text-forest/20 uppercase tracking-tighter">{{ $request->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Item Name & Quantity -->
                                    <div class="mb-6">
                                        <h4 class="font-heading text-3xl text-forest group-hover:text-earth transition-colors duration-300 leading-tight">{{ $request->product_name }}</h4>
                                        <div class="flex items-center gap-2 mt-2">
                                            <span class="text-[10px] font-black text-forest/30 uppercase tracking-[0.2em]">Volume:</span>
                                            <span class="text-xs font-bold text-earth">{{ $request->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    @if($request->notes)
                                        <div class="bg-sunlight/50 backdrop-blur-sm p-5 rounded-3xl border border-forest/5 mb-8 relative">
                                            <svg class="absolute -top-3 -left-1 w-6 h-6 text-forest/5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H14.017C13.4647 8 13.017 7.55228 13.017 7V5C13.017 4.44772 13.4647 4 14.017 4H19.017C21.2261 4 23.017 5.79086 23.017 8V15C23.017 18.3137 20.3307 21 17.017 21H14.017ZM1.017 21L1.017 18C1.017 16.8954 1.91243 16 3.017 16H6.017C6.56928 16 7.017 15.5523 7.017 15V9C7.017 8.44772 6.56928 8 6.017 8H1.017C0.464718 8 0.017 7.55228 0.017 7V5C0.017 4.44772 0.464718 4 1.017 4H6.017C8.22614 4 10.017 5.79086 10.017 8V15C10.017 18.3137 7.33071 21 4.017 21H1.017Z" /></svg>
                                            <p class="text-[13px] text-forest/70 font-medium italic leading-relaxed line-clamp-3">
                                                {{ $request->notes }}
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Card Footer -->
                                    <div class="mt-auto pt-8 border-t border-forest/5 flex items-center justify-between">
                                        @if($request->status === 'pending')
                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-amber-400/10 text-amber-600 border border-amber-400/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></span>
                                                    <span class="text-[9px] font-black uppercase tracking-widest">Live Signal</span>
                                                </div>
                                            </div>

                                            <form method="POST" action="{{ route('farmer-requests.destroy', $request) }}" onsubmit="return confirm('Are you sure you want to stop broadcasting this need?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-11 h-11 flex items-center justify-center text-forest/20 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all duration-300 group/del" title="Retract Broadcast">
                                                    <svg class="w-5 h-5 group-hover/del:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center gap-3">
                                                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald/10 text-emerald border border-emerald/20">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    <span class="text-[9px] font-black uppercase tracking-widest">Fulfilled</span>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-[8px] font-black text-forest/20 uppercase block tracking-widest">Partner</span>
                                                <span class="text-[10px] font-bold text-forest/60">{{ $request->supplier->name ?? 'Affiliate' }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-24 px-12 rounded-[4rem] border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                                <div class="w-20 h-20 rounded-full bg-sage/20 flex items-center justify-center text-3xl mb-6">📡</div>
                                <h4 class="font-heading text-2xl text-forest mb-2">No active signals found</h4>
                                <p class="text-sm text-forest/40 font-medium max-w-xs leading-relaxed">Your broadcast history is currently empty. Use the control center to notify suppliers of your needs.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        @else
            <!-- SUPPLIER VIEW -->
            <div class="space-y-16">
                <!-- Supplier Welcome & Banner -->
                <div class="relative group">
                    <div class="bg-forest p-14 md:p-20 rounded-[4rem] shadow-2xl relative overflow-hidden">
                        <!-- Premium Background Effects -->
                        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-earth/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-80 h-80 bg-gold/5 rounded-full blur-[80px] translate-y-1/2 -translate-x-1/4"></div>
                        
                        <div class="relative z-10 max-w-3xl">
                            <span class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full bg-sunlight/10 backdrop-blur-md text-gold text-[10px] font-black uppercase tracking-[0.3em] mb-10 border border-sunlight/10">
                                <span class="w-2 h-2 bg-gold rounded-full animate-pulse shadow-[0_0_10px_rgba(212,175,55,0.8)]"></span>
                                Real-time Demand Stream
                            </span>
                            <h3 class="font-heading text-6xl text-sunlight mb-8 leading-[1.1]">The Demand <br><span class="italic text-gold">Nexus.</span></h3>
                            <p class="text-sage/60 font-medium text-xl leading-relaxed max-w-2xl">
                                Intercept immediate agricultural requirements from our farmer network. Fulfill open broadcasts to secure premium partnerships.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-6">
                        <h3 class="font-heading text-5xl text-forest shrink-0">Live Farmer <span class="italic text-earth">Demands</span></h3>
                        <div class="h-px w-full bg-forest/10"></div>
                    </div>
                    <p class="text-sm font-medium text-forest/40 uppercase tracking-widest ml-1">Urgent material requests from the field</p>
                </div>

                <!-- Live Requests Board -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @forelse($farmerRequests as $request)
                        <div class="bg-white p-10 rounded-[3.5rem] border border-forest/5 shadow-xl shadow-forest/[0.02] hover:shadow-2xl hover:shadow-forest/5 transition-all duration-500 relative overflow-hidden group flex flex-col justify-between min-h-[420px]">
                            
                            <div>
                                <!-- Header Info -->
                                <div class="flex items-center justify-between mb-10 pb-6 border-b border-forest/5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-forest flex items-center justify-center font-black text-xs text-gold shadow-lg shadow-forest/20 rotate-3 group-hover:rotate-0 transition-transform">
                                            {{ strtoupper(substr($request->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="text-sm font-black text-forest block leading-none tracking-tight">{{ $request->user->name }}</span>
                                            <span class="text-[9px] font-bold text-forest/30 uppercase mt-1.5 block tracking-widest">Verified Farmer</span>
                                        </div>
                                    </div>
                                    <span class="text-[9px] font-bold text-forest/20 uppercase tracking-tighter">{{ $request->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Urgency level badge -->
                                <div class="mb-6">
                                    @if($request->urgency === 'high')
                                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-red-50 text-red-600 border border-red-100 shadow-sm shadow-red-500/5">
                                            <span class="animate-ping w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                            <span class="text-[9px] font-black uppercase tracking-widest">High Priority</span>
                                        </div>
                                    @elseif($request->urgency === 'medium')
                                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-earth/5 text-earth border border-earth/10">
                                            <span class="w-1.5 h-1.5 rounded-full bg-earth"></span>
                                            <span class="text-[9px] font-black uppercase tracking-widest">Mid Priority</span>
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-sage/20 text-forest/60 border border-forest/5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald"></span>
                                            <span class="text-[9px] font-black uppercase tracking-widest">Standard</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Request Title & volume -->
                                <div class="mb-8">
                                    <h4 class="font-heading text-4xl text-forest group-hover:text-earth transition-colors duration-500 leading-tight mb-3">{{ $request->product_name }}</h4>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-[10px] font-black text-forest/30 uppercase tracking-[0.2em]">Target Vol:</span>
                                        <span class="text-lg font-bold text-earth leading-none">{{ $request->quantity }}</span>
                                    </div>
                                </div>

                                <!-- Notes -->
                                @if($request->notes)
                                    <div class="bg-sage/5 p-6 rounded-[2rem] border border-forest/5 mb-10 relative">
                                        <p class="text-sm text-forest/60 font-medium italic leading-relaxed line-clamp-4">
                                            "{{ $request->notes }}"
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Footer Action: Fulfill Request -->
                            <div class="pt-8 border-t border-forest/5 flex items-center justify-between mt-auto">
                                @if($request->status === 'pending')
                                    <div class="flex flex-col">
                                        <span class="text-[8px] font-black text-forest/20 uppercase tracking-[0.2em] mb-1">Status</span>
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span class="text-[10px] font-black text-amber-500 uppercase tracking-widest">Awaiting Solution</span>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('farmer-requests.fulfill', $request) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-3 bg-forest text-gold px-8 py-4 rounded-full text-[10px] font-black uppercase tracking-[0.2em] hover:bg-gold hover:text-forest hover:shadow-2xl hover:shadow-gold/20 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 transition-all shadow-xl shadow-forest/10 group/btn">
                                            <span>Fulfill Demand</span>
                                            <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald/10 flex items-center justify-center text-emerald">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div>
                                            <span class="text-[9px] font-black text-emerald uppercase tracking-widest block leading-none">Fulfilled</span>
                                            <span class="text-[10px] font-bold text-forest/40 mt-1 block">Resolved by {{ $request->supplier->name ?? 'Affiliate' }}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-40 px-12 rounded-[5rem] border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                            <div class="w-24 h-24 rounded-full bg-sage/20 flex items-center justify-center text-4xl mb-8">📭</div>
                            <h4 class="font-heading text-3xl text-forest mb-4">No Active Demands Detected</h4>
                            <p class="text-base text-forest/40 font-medium max-w-sm leading-relaxed">The demand board is currently clear. Active farmer requests will appear here in real-time as they are broadcast.</p>
                        </div>
                    @endforelse
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
