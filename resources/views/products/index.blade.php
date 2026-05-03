<x-app-layout>
    <x-slot name="header">
        The Marketplace
    </x-slot>

    <!-- Interactive Category Filter Bar -->
    <div class="mb-16">
        <div class="flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('products.index', ['category' => 'all']) }}" 
               class="px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest transition-all {{ request('category', 'all') === 'all' ? 'bg-forest text-white shadow-xl shadow-forest/20' : 'bg-white text-gray-400 hover:text-forest border border-sage/50' }}">
                All Products
            </a>
            <a href="{{ route('products.index', ['category' => 'seeds']) }}" 
               class="px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest transition-all {{ request('category') === 'seeds' ? 'bg-forest text-white shadow-xl shadow-forest/20' : 'bg-white text-gray-400 hover:text-forest border border-sage/50' }}">
                Seeds 🌱
            </a>
            <a href="{{ route('products.index', ['category' => 'manures']) }}" 
               class="px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest transition-all {{ request('category') === 'manures' ? 'bg-forest text-white shadow-xl shadow-forest/20' : 'bg-white text-gray-400 hover:text-forest border border-sage/50' }}">
                Manures 💩
            </a>
            <a href="{{ route('products.index', ['category' => 'fertilizers']) }}" 
               class="px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest transition-all {{ request('category') === 'fertilizers' ? 'bg-forest text-white shadow-xl shadow-forest/20' : 'bg-white text-gray-400 hover:text-forest border border-sage/50' }}">
                Fertilizers 🧪
            </a>
            <a href="{{ route('products.index', ['category' => 'tools']) }}" 
               class="px-8 py-3 rounded-full font-bold text-xs uppercase tracking-widest transition-all {{ request('category') === 'tools' ? 'bg-forest text-white shadow-xl shadow-forest/20' : 'bg-white text-gray-400 hover:text-forest border border-sage/50' }}">
                Tools 🚜
            </a>
        </div>
    </div>

    <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <p class="text-gray-600 max-w-xl font-medium italic">
                @if(request('category'))
                    Showing all <span class="text-forest font-bold underline decoration-earth underline-offset-4 capitalize">{{ request('category') }}</span> for your farm.
                @else
                    "Direct from supplier, quality guaranteed. Find the exact inputs your farm deserves."
                @endif
            </p>
        </div>
        
        @if(auth()->user()->role === 'supplier')
            <a href="{{ route('products.create') }}" class="bg-earth text-white px-8 py-4 rounded-full font-bold hover:bg-forest transition-all shadow-xl flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                List New Product
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($products as $product)
            <div class="bg-white rounded-[2.5rem] border border-sage/50 overflow-hidden hover:shadow-2xl transition-all group flex flex-col h-full">
                <!-- Hyper-Specific Product Photography -->
                <div class="h-64 relative overflow-hidden bg-sage/10">
                    <img src="{{ $product->image_url }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=800';">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
                        <p class="text-white text-xs font-bold uppercase tracking-widest">In Stock: {{ $product->stock_quantity }}</p>
                    </div>
                    
                    <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] text-forest shadow-sm">
                        {{ $product->category }}
                    </div>
                </div>
                
                <div class="p-10 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="font-heading text-2xl text-forest leading-tight">{{ $product->name }}</h3>
                        <span class="text-earth font-bold text-2xl">₹{{ number_format($product->price, 0) }}</span>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-8 line-clamp-2 italic font-medium leading-relaxed">"{{ $product->description }}"</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-8 border-t border-sage/20">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-forest text-white flex items-center justify-center text-[10px] font-bold">
                                {{ substr($product->user->name, 0, 1) }}
                            </div>
                            <div class="text-[10px]">
                                <p class="text-gray-400 font-bold uppercase tracking-widest leading-none mb-1">Supplier</p>
                                <p class="font-bold text-forest leading-none">{{ $product->user->name }}</p>
                            </div>
                        </div>
                        
                        @if(auth()->user()->role === 'farmer')
                            <form action="{{ route('products.buy', $product) }}" method="POST">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-forest text-white px-6 py-3 rounded-2xl hover:bg-earth transition-all shadow-lg hover:shadow-earth/20 flex items-center gap-2 group/btn">
                                    <span class="text-[10px] font-bold uppercase tracking-widest">Order</span>
                                    <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-sage">
                <p class="text-gray-400 italic text-lg font-medium">No products found in this category.</p>
                <a href="{{ route('products.index') }}" class="text-forest font-bold underline mt-4 inline-block">View all products</a>
            </div>
        @endforelse
    </div>
</x-app-layout>
