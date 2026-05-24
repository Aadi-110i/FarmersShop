<x-app-layout>
    <x-slot name="header">
        Broadcasting Hub
    </x-slot>

    <div class="space-y-12">
        <!-- Toast Notification Error -->
        @if(session('error'))
            <div class="bg-red-600/10 border border-red-600 text-red-600 p-6 rounded-[2rem] flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-3">
                    <span class="text-xl">⚠️</span>
                    <p class="text-xs font-bold uppercase tracking-wider">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @if(auth()->user()->role === 'farmer')
            <!-- FARMER VIEW -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Broadcast Form Card -->
                <div class="bg-white p-8 md:p-10 rounded-[3rem] border border-forest/5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="mb-6">
                        <span class="text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-2 block">Create Live broadcast</span>
                        <h3 class="font-heading text-3xl text-forest">What do you <span class="italic text-earth">need?</span></h3>
                        <p class="text-xs text-gray-500 mt-2">Broadcast your immediate material requirements to local suppliers.</p>
                    </div>

                    <form method="POST" action="{{ route('farmer-requests.store') }}" class="space-y-6">
                        @csrf

                        <!-- Item Name -->
                        <div>
                            <x-input-label for="product_name" :value="__('Item / Provision Name')" class="text-[9px] font-bold uppercase tracking-widest text-forest/50" />
                            <x-text-input id="product_name" class="block mt-1.5 w-full bg-sage/10 border-forest/10 focus:ring-forest focus:border-forest rounded-2xl py-3.5 px-4 text-sm text-forest" type="text" name="product_name" :value="old('product_name')" placeholder="e.g. Hybrid Basmati Seeds" required />
                            <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div>
                            <x-input-label for="quantity" :value="__('Required Volume / Quantity')" class="text-[9px] font-bold uppercase tracking-widest text-forest/50" />
                            <x-text-input id="quantity" class="block mt-1.5 w-full bg-sage/10 border-forest/10 focus:ring-forest focus:border-forest rounded-2xl py-3.5 px-4 text-sm text-forest" type="text" name="quantity" :value="old('quantity')" placeholder="e.g. 50 kg or 10 Bags" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <!-- Urgency Selector (Segmented Radio Controls) -->
                        <div>
                            <x-input-label :value="__('Urgency Level')" class="text-[9px] font-bold uppercase tracking-widest text-forest/50 mb-2" />
                            <div class="grid grid-cols-3 gap-3">
                                <!-- Low Urgency -->
                                <label class="cursor-pointer group">
                                    <input type="radio" name="urgency" value="low" class="sr-only peer">
                                    <div class="py-3 px-2 rounded-2xl border border-forest/10 bg-sage/10 text-forest/40 text-center font-bold text-[10px] uppercase tracking-wider transition-all peer-checked:bg-sage/40 peer-checked:text-forest peer-checked:border-forest hover:bg-sage/20 flex flex-col items-center gap-1">
                                        <span class="text-base">🍃</span>
                                        <span>Low</span>
                                    </div>
                                </label>
                                
                                <!-- Medium Urgency -->
                                <label class="cursor-pointer group">
                                    <input type="radio" name="urgency" value="medium" class="sr-only peer" checked>
                                    <div class="py-3 px-2 rounded-2xl border border-forest/10 bg-sage/10 text-forest/40 text-center font-bold text-[10px] uppercase tracking-wider transition-all peer-checked:bg-earth/15 peer-checked:text-earth peer-checked:border-earth hover:bg-sage/20 flex flex-col items-center gap-1">
                                        <span class="text-base">⚡</span>
                                        <span>Medium</span>
                                    </div>
                                </label>

                                <!-- High Urgency -->
                                <label class="cursor-pointer group">
                                    <input type="radio" name="urgency" value="high" class="sr-only peer">
                                    <div class="py-3 px-2 rounded-2xl border border-forest/10 bg-sage/10 text-forest/40 text-center font-bold text-[10px] uppercase tracking-wider transition-all peer-checked:bg-red-600/10 peer-checked:text-red-600 peer-checked:border-red-600 hover:bg-sage/20 flex flex-col items-center gap-1">
                                        <span class="text-base">🚨</span>
                                        <span>High</span>
                                    </div>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('urgency')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div>
                            <x-input-label for="notes" :value="__('Additional Notes / Specifications')" class="text-[9px] font-bold uppercase tracking-widest text-forest/50" />
                            <textarea id="notes" name="notes" rows="3" class="block mt-1.5 w-full bg-sage/10 border-forest/10 focus:ring-forest focus:border-forest rounded-2xl py-3 px-4 text-sm text-forest" placeholder="Describe soil requirements, brand preferences, or timing... (Optional)">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <button type="submit" class="w-full bg-forest text-sunlight py-4 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:bg-forest/90 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-forest/10 mt-4">
                            Broadcast Need
                        </button>
                    </form>
                </div>

                <!-- Your Active Needs Grid -->
                <div class="lg:col-span-2 space-y-8">
                    <div class="flex items-center gap-6">
                        <h3 class="font-heading text-4xl text-forest shrink-0">Your Active <span class="italic text-earth">Broadcasts</span></h3>
                        <div class="h-px w-full bg-forest/10"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($farmerRequests as $request)
                            <div class="bg-white p-8 rounded-[2.5rem] border border-forest/5 shadow-sm hover:shadow-xl transition-all duration-300 relative overflow-hidden group flex flex-col justify-between min-h-[250px]">
                                
                                <div>
                                    <!-- Card Header: Urgency and status -->
                                    <div class="flex items-center justify-between mb-6">
                                        @if($request->urgency === 'high')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600/10 text-red-600 text-[8px] font-black uppercase tracking-widest">🚨 High Urgency</span>
                                        @elseif($request->urgency === 'medium')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-earth/10 text-earth text-[8px] font-black uppercase tracking-widest">⚡ Medium Urgency</span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sage text-forest text-[8px] font-black uppercase tracking-widest">🍃 Low Urgency</span>
                                        @endif

                                        <span class="text-[9px] font-bold text-forest/30 uppercase">{{ $request->created_at->diffForHumans() }}</span>
                                    </div>

                                    <!-- Item Name & Quantity -->
                                    <div class="mb-4">
                                        <h4 class="font-heading text-2xl text-forest">{{ $request->product_name }}</h4>
                                        <p class="text-sm font-bold text-earth uppercase tracking-wider mt-1">Needed: {{ $request->quantity }}</p>
                                    </div>

                                    <!-- Notes -->
                                    @if($request->notes)
                                        <p class="text-xs text-gray-500 font-medium italic line-clamp-3 mb-6 bg-sage/5 p-4 rounded-xl border border-forest/5">
                                            "{{ $request->notes }}"
                                        </p>
                                    @endif
                                </div>

                                <!-- Card Footer: Status & Actions -->
                                <div class="pt-6 border-t border-forest/5 flex items-center justify-between mt-auto">
                                    @if($request->status === 'pending')
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span class="text-[9px] font-bold text-amber-500 uppercase tracking-widest">Broadcast Live</span>
                                        </div>

                                        <form method="POST" action="{{ route('farmer-requests.destroy', $request) }}" onsubmit="return confirm('Are you sure you want to stop broadcasting this need?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2.5 text-forest/40 hover:text-red-600 hover:bg-red-600/5 rounded-full transition-colors" title="Delete Broadcast">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald"></span>
                                            <span class="text-[9px] font-bold text-emerald uppercase tracking-widest">Fulfilled</span>
                                        </div>
                                        <span class="text-[9px] font-bold text-forest/40">Resolved by {{ $request->supplier->name ?? 'Supplier' }}</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white/50 border border-forest/5 rounded-[3.5rem] py-20 text-center text-forest/30 italic font-medium">
                                No live broadcasts recorded. Use the form to broadcast what you need immediately.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        @else
            <!-- SUPPLIER VIEW -->
            <div class="space-y-8">
                <!-- Supplier Welcome & Banner -->
                <div class="bg-forest text-sunlight p-10 md:p-14 rounded-[3.5rem] shadow-2xl relative overflow-hidden">
                    <div class="relative z-10 max-w-2xl">
                        <span class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-sunlight/10 text-sunlight/80 text-[10px] font-bold uppercase tracking-widest mb-6 border border-sunlight/5">
                            <span class="w-1.5 h-1.5 bg-earth rounded-full animate-pulse"></span>
                            Live Demand Feeder
                        </span>
                        <h3 class="font-heading text-5xl mb-4 leading-tight">Farmer Demand Board</h3>
                        <p class="text-sage/60 font-medium text-lg leading-relaxed">
                            Observe immediate agricultural needs reported by farmers. Contact them or update your inventory to meet these real-time requirements.
                        </p>
                    </div>
                    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-earth/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
                </div>

                <div class="flex items-center gap-6">
                    <h3 class="font-heading text-4xl text-forest shrink-0">Live Farmer <span class="italic text-earth">Needs</span></h3>
                    <div class="h-px w-full bg-forest/10"></div>
                </div>

                <!-- Live Requests Board -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($farmerRequests as $request)
                        <div class="bg-white p-8 rounded-[2.5rem] border border-forest/5 shadow-sm hover:shadow-xl transition-all duration-300 relative overflow-hidden group flex flex-col justify-between min-h-[300px]">
                            
                            <div>
                                <!-- Header Info: Farmer name and time -->
                                <div class="flex items-center justify-between mb-6 pb-4 border-b border-forest/5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-sage/30 flex items-center justify-center font-bold text-[10px] text-forest">
                                            {{ strtoupper(substr($request->user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="text-xs font-bold text-forest block leading-none">{{ $request->user->name }}</span>
                                            <span class="text-[8px] font-bold text-forest/30 uppercase mt-1 block">Farmer Affiliate</span>
                                        </div>
                                    </div>
                                    <span class="text-[9px] font-bold text-forest/30 uppercase">{{ $request->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Urgency level badge -->
                                <div class="mb-4">
                                    @if($request->urgency === 'high')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-600/10 text-red-600 text-[8px] font-black uppercase tracking-widest">🚨 High Urgency</span>
                                    @elseif($request->urgency === 'medium')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-earth/10 text-earth text-[8px] font-black uppercase tracking-widest">⚡ Medium Urgency</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sage text-forest text-[8px] font-black uppercase tracking-widest">🍃 Low Urgency</span>
                                    @endif
                                </div>

                                <!-- Request Title & volume -->
                                <div class="mb-4">
                                    <h4 class="font-heading text-2xl text-forest">{{ $request->product_name }}</h4>
                                    <p class="text-sm font-bold text-earth uppercase tracking-wider mt-1">Needed Volume: {{ $request->quantity }}</p>
                                </div>

                                <!-- Notes -->
                                @if($request->notes)
                                    <p class="text-xs text-gray-500 font-medium italic line-clamp-3 mb-6 bg-sage/5 p-4 rounded-xl border border-forest/5">
                                        "{{ $request->notes }}"
                                    </p>
                                @endif
                            </div>

                            <!-- Footer Action: Fulfill Request -->
                            <div class="pt-6 border-t border-forest/5 flex items-center justify-between mt-auto">
                                @if($request->status === 'pending')
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                        <span class="text-[9px] font-bold text-amber-500 uppercase tracking-widest">Open Request</span>
                                    </div>

                                    <form method="POST" action="{{ route('farmer-requests.fulfill', $request) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center gap-2 bg-forest text-gold px-5 py-2.5 rounded-full text-[9px] font-bold uppercase tracking-widest hover:bg-gold hover:text-forest transition-colors shadow-md">
                                            Fulfill Need
                                        </button>
                                    </form>
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald"></span>
                                        <span class="text-[9px] font-bold text-emerald uppercase tracking-widest">Fulfilled</span>
                                    </div>
                                    <span class="text-[9px] font-bold text-forest/40">Resolved by {{ $request->supplier->name ?? 'Supplier' }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white/50 border border-forest/5 rounded-[3.5rem] py-20 text-center text-forest/30 italic font-medium">
                            No active farmer needs recorded at this moment. Check back later!
                        </div>
                    @endforelse
                </div>
            </div>
        @endif

    </div>

    <style>
        .font-heading { font-family: 'Fraunces', serif; }
    </style>
</x-app-layout>
