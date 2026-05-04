<x-app-layout>
    <x-slot name="header">
        Marketplace <span class="text-gold italic">Provisions</span>
    </x-slot>

    <!-- Interactive Category Filter Bar -->
    <div class="mb-20">
        <div class="flex flex-wrap items-center justify-center gap-6">
            @php $categories = ['all' => 'All', 'seeds' => 'Seeds', 'manures' => 'Manures', 'fertilizers' => 'Fertilizers', 'tools' => 'Tools']; @endphp
            @foreach($categories as $slug => $label)
                <a href="{{ route('products.index', ['category' => $slug]) }}" 
                   class="px-10 py-4 rounded-full font-bold text-[10px] uppercase tracking-[0.2em] transition-all {{ (request('category', 'all') === $slug) ? 'bg-forest text-gold shadow-2xl shadow-forest/20' : 'bg-white/50 text-forest/40 hover:text-forest border border-forest/5' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="mb-16 flex flex-col md:flex-row justify-between items-end gap-8">
        <div class="max-w-xl">
            <p class="text-forest/60 font-medium italic leading-relaxed text-lg">
                @if(request('category'))
                    Curating the finest <span class="text-forest font-bold underline decoration-gold underline-offset-8 capitalize">{{ request('category') }}</span> for your estate.
                @else
                    "Sourced from local stewards, guaranteed by the earth. Find the exact provisions your harvest demands."
                @endif
            </p>
        </div>
        
        @if(auth()->user()->role === 'supplier')
            <a href="{{ route('products.create') }}" class="bg-forest text-gold px-10 py-5 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-gold hover:text-forest transition-all shadow-xl flex items-center gap-3 group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Provision New Item
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
        @forelse($products as $product)
            <div class="group bg-white/40 backdrop-blur-md rounded-[3rem] border border-forest/5 overflow-hidden hover:shadow-2xl transition-all duration-700 flex flex-col h-full premium-shadow">
                <!-- Product Photography -->
                <div class="h-80 relative overflow-hidden bg-forest/5">
                    <img src="{{ $product->image_url }}" 
                         class="w-full h-full object-cover grayscale-[0.2] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-1000" 
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=800';">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-forest/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700 flex items-end p-10">
                        <p class="text-gold text-[10px] font-bold uppercase tracking-[0.3em]">Inventory: {{ $product->stock_quantity }} Units</p>
                    </div>
                    
                    <div class="absolute top-8 left-8 bg-cream/90 backdrop-blur-md px-5 py-2 rounded-full text-[9px] font-bold uppercase tracking-[0.2em] text-forest shadow-sm border border-forest/5">
                        {{ $product->category }}
                    </div>
                </div>
                
                <div class="p-12 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="font-heading text-3xl text-forest leading-none">{{ $product->name }}</h3>
                        <span class="text-gold font-light italic text-2xl">₹{{ number_format($product->price, 0) }}</span>
                    </div>
                    
                    <p class="text-sm text-forest/50 mb-10 line-clamp-2 italic font-medium leading-loose">"{{ $product->description }}"</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-10 border-t border-forest/5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-forest text-gold flex items-center justify-center text-[10px] font-black italic">
                                {{ substr($product->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-[8px] text-forest/30 font-black uppercase tracking-[0.2em] mb-1">Steward</p>
                                <p class="font-bold text-forest text-[10px] uppercase tracking-widest">{{ $product->user->name }}</p>
                            </div>
                        </div>
                        
                        @if(auth()->user()->role === 'farmer')
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-forest text-gold px-8 py-4 rounded-full hover:bg-gold hover:text-forest transition-all shadow-lg flex items-center gap-3 group/btn">
                                    <span class="text-[9px] font-bold uppercase tracking-[0.2em]">Acquire</span>
                                    <svg class="w-4 h-4 group-hover/btn:translate-y-[-2px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-40 text-center bg-white/40 rounded-[4rem] border border-dashed border-forest/10">
                <p class="text-forest/30 italic text-xl font-medium">No provisions found in this collection.</p>
                <a href="{{ route('products.index') }}" class="text-gold font-bold uppercase tracking-widest text-[10px] mt-6 inline-block underline underline-offset-8">Return to all provisions</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
