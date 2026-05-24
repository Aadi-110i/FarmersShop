<x-app-layout>
    <x-slot name="header">
        Broadcasting Hub
    </x-slot>

    <div class="space-y-8 py-4">
        <!-- Toast Notification Error -->
        @if(session('error'))
            <div class="bg-red-50/80 backdrop-blur-md border border-red-200 text-red-700 p-4 rounded-[2rem] flex items-center justify-between shadow-xl shadow-red-900/5 max-w-4xl mx-auto">
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
            <!-- FARMER VIEW -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Broadcast Form Card -->
                <div class="lg:col-span-4 sticky top-8">
                    <div class="bg-white p-6 md:p-8 rounded-[2.5rem] border border-forest/5 shadow-2xl shadow-forest/5 relative overflow-hidden group">
                        <!-- Decorative element -->
                        <div class="absolute -top-16 -right-16 w-32 h-32 bg-sage/20 rounded-full blur-2xl group-hover:bg-sage/30 transition-colors duration-500"></div>
                        
                        <div class="relative z-10">
                            <div class="mb-6">
                                <span class="inline-block px-3 py-1 rounded-full bg-sage/30 text-forest text-[8px] font-bold uppercase tracking-[0.2em] mb-2">Live Broadcast</span>
                                <h3 class="font-heading text-2xl text-forest leading-tight">What do you <br><span class="italic text-earth">need?</span></h3>
                            </div>

                            <form method="POST" action="{{ route('farmer-requests.store') }}" class="space-y-5">
                                @csrf

                                <!-- Item Name -->
                                <div class="space-y-1.5">
                                    <label for="product_name" class="text-[9px] font-black uppercase tracking-[0.15em] text-forest/40 ml-1">Provision Name</label>
                                    <div class="relative">
                                        <input id="product_name" type="text" name="product_name" value="{{ old('product_name') }}" placeholder="e.g. Hybrid Basmati Seeds" required
                                            class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-xl py-3 px-4 text-xs font-bold text-forest transition-all placeholder:text-forest/20 placeholder:font-normal" />
                                    </div>
                                    <x-input-error :messages="$errors->get('product_name')" class="mt-1" />
                                </div>

                                <!-- Quantity -->
                                <div class="space-y-1.5">
                                    <label for="quantity" class="text-[9px] font-black uppercase tracking-[0.15em] text-forest/40 ml-1">Required Volume</label>
                                    <div class="relative">
                                        <input id="quantity" type="text" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 50 kg or 10 Bags" required
                                            class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-xl py-3 px-4 text-xs font-bold text-forest transition-all placeholder:text-forest/20 placeholder:font-normal" />
                                    </div>
                                    <x-input-error :messages="$errors->get('quantity')" class="mt-1" />
                                </div>

                                <!-- Urgency Selector -->
                                <div class="space-y-2">
                                    <label class="text-[9px] font-black uppercase tracking-[0.15em] text-forest/40 ml-1">Urgency</label>
                                    <div class="grid grid-cols-3 gap-2">
                                        @foreach(['low' => '🍃 Low', 'medium' => '⚡ Mid', 'high' => '🚨 High'] as $val => $label)
                                            <label class="cursor-pointer">
                                                <input type="radio" name="urgency" value="{{ $val }}" class="sr-only peer" {{ ($val === 'medium' || old('urgency') === $val) ? 'checked' : '' }}>
                                                <div class="py-2.5 px-1 rounded-xl border-2 border-forest/5 bg-sage/5 text-forest/40 text-center font-black text-[8px] uppercase tracking-widest transition-all peer-checked:bg-forest peer-checked:text-sunlight peer-checked:border-forest hover:bg-sage/10 flex flex-col items-center gap-1 shadow-sm active:scale-95">
                                                    {{ $label }}
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('urgency')" class="mt-1" />
                                </div>

                                <!-- Notes -->
                                <div class="space-y-1.5">
                                    <label for="notes" class="text-[9px] font-black uppercase tracking-[0.15em] text-forest/40 ml-1">Specs (Optional)</label>
                                    <textarea id="notes" name="notes" rows="3" 
                                        class="block w-full bg-sage/5 border-2 border-forest/5 focus:border-forest/20 focus:ring-0 rounded-2xl py-3 px-4 text-xs font-medium text-forest transition-all placeholder:text-forest/20"
                                        placeholder="Describe requirements...">{{ old('notes') }}</textarea>
                                    <x-input-error :messages="$errors->get('notes')" class="mt-1" />
                                </div>

                                <button type="submit" class="w-full bg-forest text-gold py-3.5 rounded-full font-black text-[10px] uppercase tracking-[0.25em] hover:bg-forest/95 hover:shadow-xl hover:shadow-forest/20 hover:-translate-y-0.5 active:translate-y-0 active:scale-95 transition-all shadow-lg shadow-forest/10 flex items-center justify-center gap-2">
                                    <span>Broadcast</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Your Active Needs Grid -->
                <div class="lg:col-span-8 space-y-6">
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center gap-4">
                            <h3 class="font-heading text-3xl text-forest shrink-0">Your <span class="italic text-earth">Broadcasts</span></h3>
                            <div class="h-px w-full bg-forest/10"></div>
                        </div>
                        <p class="text-[10px] font-medium text-forest/40 uppercase tracking-widest ml-1">Live status of your marketplace demands</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($farmerRequests as $request)
                            <div class="bg-white/60 backdrop-blur-xl p-6 rounded-[2rem] border border-forest/5 shadow-lg shadow-forest/[0.01] hover:shadow-xl hover:shadow-forest/5 transition-all duration-500 relative overflow-hidden group flex flex-col min-h-[220px]">
                                
                                <div class="relative z-10 flex flex-col flex-grow">
                                    <!-- Card Header -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2">
                                            @if($request->urgency === 'high')
                                                <div class="w-1.5 h-1.5 rounded-full bg-red-600 animate-ping"></div>
                                                <span class="text-[7px] font-black text-red-600 uppercase tracking-widest">Urgent</span>
                                            @elseif($request->urgency === 'medium')
                                                <div class="w-1.5 h-1.5 rounded-full bg-earth"></div>
                                                <span class="text-[7px] font-black text-earth uppercase tracking-widest">Mid Priority</span>
                                            @else
                                                <div class="w-1.5 h-1.5 rounded-full bg-emerald"></div>
                                                <span class="text-[7px] font-black text-emerald uppercase tracking-widest">Standard</span>
                                            @endif
                                        </div>
                                        <span class="text-[8px] font-bold text-forest/20 uppercase tracking-tighter">{{ $request->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Item Name & Quantity -->
                                    <div class="mb-3">
                                        <h4 class="font-heading text-xl text-forest group-hover:text-earth transition-colors duration-300 leading-tight">{{ $request->product_name }}</h4>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="text-[8px] font-black text-forest/30 uppercase tracking-[0.1em]">Volume:</span>
                                            <span class="text-xs font-bold text-earth">{{ $request->quantity }}</span>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    @if($request->notes)
                                        <div class="bg-sunlight/50 backdrop-blur-sm p-3 rounded-xl border border-forest/5 mb-4 relative">
                                            <p class="text-xs text-forest/70 font-medium italic leading-relaxed line-clamp-2">
                                                "{{ $request->notes }}"
                                            </p>
                                        </div>
                                    @endif

                                    <!-- Card Footer -->
                                    <div class="mt-auto pt-4 border-t border-forest/5 flex items-center justify-between">
                                        @if($request->status === 'pending')
                                            <div class="flex items-center gap-1.5 px-2 py-1 rounded-full bg-amber-400/10 text-amber-600 border border-amber-400/20">
                                                <span class="w-1 h-1 rounded-full bg-amber-600 animate-pulse"></span>
                                                <span class="text-[8px] font-black uppercase tracking-widest text-nowrap">Live Signal</span>
                                            </div>

                                            <form method="POST" action="{{ route('farmer-requests.destroy', $request) }}" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center text-forest/20 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-300 group/del">
                                                    <svg class="w-4 h-4 group-hover/del:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <div class="flex items-center gap-1.5 px-2 py-1 rounded-full bg-emerald/10 text-emerald border border-emerald/20">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="text-[8px] font-black uppercase tracking-widest">Fulfilled</span>
                                            </div>
                                            <div class="text-right">
                                                <span class="text-[9px] font-bold text-forest/60">{{ explode(' ', $request->supplier->name)[0] }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 px-6 rounded-[2.5rem] border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                                <div class="w-12 h-12 rounded-full bg-sage/20 flex items-center justify-center text-2xl mb-4">📡</div>
                                <h4 class="font-heading text-xl text-forest mb-1">No active signals</h4>
                                <p class="text-xs text-forest/40 font-medium max-w-xs leading-relaxed">Your broadcast history is empty.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        @else
            <!-- SUPPLIER VIEW -->
            <div class="space-y-8">
                <!-- Supplier Welcome & Banner -->
                <div class="relative group">
                    <div class="bg-forest p-8 md:p-12 rounded-[3rem] shadow-2xl relative overflow-hidden">
                        <!-- Premium Background Effects -->
                        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-earth/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
                        
                        <div class="relative z-10 max-w-2xl">
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-sunlight/10 backdrop-blur-md text-gold text-[8px] font-black uppercase tracking-[0.2em] mb-4 border border-sunlight/10">
                                <span class="w-1.5 h-1.5 bg-gold rounded-full animate-pulse shadow-[0_0_5px_rgba(212,175,55,0.8)]"></span>
                                Live Stream
                            </span>
                            <h3 class="font-heading text-4xl text-sunlight mb-4 leading-tight">The Demand <span class="italic text-gold">Nexus.</span></h3>
                            <p class="text-sage/60 font-medium text-sm leading-relaxed max-w-xl">
                                Intercept immediate requirements from farmers. Fulfill open broadcasts to secure premium partnerships.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-4">
                        <h3 class="font-heading text-3xl text-forest shrink-0">Farmer <span class="italic text-earth">Demands</span></h3>
                        <div class="h-px w-full bg-forest/10"></div>
                    </div>
                    <p class="text-[10px] font-medium text-forest/40 uppercase tracking-widest ml-1">Urgent requests from the field</p>
                </div>

                <!-- Live Requests Board -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($farmerRequests as $request)
                        <div class="bg-white p-6 rounded-[2.5rem] border border-forest/5 shadow-lg shadow-forest/[0.01] hover:shadow-xl hover:shadow-forest/5 transition-all duration-500 relative overflow-hidden group flex flex-col justify-between min-h-[300px]">
                            
                            <div>
                                <!-- Header Info -->
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-forest/5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-xl bg-forest flex items-center justify-center font-black text-[10px] text-gold shadow-lg shadow-forest/20 rotate-3 group-hover:rotate-0 transition-transform text-nowrap">
                                            {{ strtoupper(substr($request->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="text-xs font-black text-forest block leading-none tracking-tight">{{ explode(' ', $request->user->name)[0] }}</span>
                                            <span class="text-[7px] font-bold text-forest/30 uppercase mt-1 block tracking-widest">Farmer</span>
                                        </div>
                                    </div>
                                    <span class="text-[8px] font-bold text-forest/20 uppercase tracking-tighter">{{ $request->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Urgency level badge -->
                                <div class="mb-4">
                                    @if($request->urgency === 'high')
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-red-50 text-red-600 border border-red-100 shadow-sm shadow-red-500/5">
                                            <span class="animate-ping w-1 h-1 rounded-full bg-red-600"></span>
                                            <span class="text-[8px] font-black uppercase tracking-widest">High Priority</span>
                                        </div>
                                    @elseif($request->urgency === 'medium')
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-earth/5 text-earth border border-earth/10">
                                            <span class="text-[8px] font-black uppercase tracking-widest">Mid Priority</span>
                                        </div>
                                    @else
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-sage/20 text-forest/60 border border-forest/5">
                                            <span class="text-[8px] font-black uppercase tracking-widest">Standard</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Request Title & volume -->
                                <div class="mb-4">
                                    <h4 class="font-heading text-2xl text-forest group-hover:text-earth transition-colors duration-500 leading-tight mb-2">{{ $request->product_name }}</h4>
                                    <div class="flex items-baseline gap-1.5">
                                        <span class="text-[9px] font-black text-forest/30 uppercase tracking-[0.1em]">Target Vol:</span>
                                        <span class="text-sm font-bold text-earth leading-none">{{ $request->quantity }}</span>
                                    </div>
                                </div>

                                <!-- Notes -->
                                @if($request->notes)
                                    <div class="bg-sage/5 p-3 rounded-2xl border border-forest/5 mb-6 relative">
                                        <p class="text-[11px] text-forest/60 font-medium italic leading-relaxed line-clamp-3">
                                            "{{ $request->notes }}"
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <!-- Footer Action: Fulfill Request -->
                            <div class="pt-4 border-t border-forest/5 flex items-center justify-between mt-auto">
                                @if($request->status === 'pending')
                                    <div class="flex flex-col">
                                        <div class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span class="text-[8px] font-black text-amber-500 uppercase tracking-widest">Awaiting</span>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('farmer-requests.fulfill', $request) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-2 bg-forest text-gold px-5 py-2.5 rounded-full text-[9px] font-black uppercase tracking-[0.1em] hover:bg-gold hover:text-forest hover:shadow-xl transition-all shadow-lg group/btn active:scale-95">
                                            <span>Fulfill</span>
                                            <svg class="w-3 h-3 group-hover/btn:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-emerald/10 flex items-center justify-center text-emerald">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <span class="text-[8px] font-black text-emerald uppercase tracking-widest">Fulfilled</span>
                                    </div>
                                    <span class="text-[9px] font-bold text-forest/40">{{ explode(' ', $request->supplier->name ?? 'Partner')[0] }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-20 px-6 rounded-[3rem] border-2 border-dashed border-forest/10 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 rounded-full bg-sage/20 flex items-center justify-center text-3xl mb-4">📭</div>
                            <h4 class="font-heading text-xl text-forest mb-2">No Active Demands</h4>
                            <p class="text-xs text-forest/40 font-medium max-w-xs leading-relaxed">The demand board is clear.</p>
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
