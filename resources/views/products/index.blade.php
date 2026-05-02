<x-app-layout>
    <x-slot name="header">
        The Marketplace
    </x-slot>

    <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <p class="text-gray-600 max-w-xl">
                Discover high-quality agricultural inputs from trusted suppliers. Filter by category to find exactly what your farm needs.
            </p>
        </div>
        
        @if(auth()->user()->role === 'supplier')
            <a href="{{ route('products.create') }}" class="bg-[var(--earth-brown)] text-white px-6 py-3 rounded-full font-bold hover:bg-[var(--forest-green)] transition-all shadow-lg flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                List New Product
            </a>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
            <div class="bg-white rounded-[2rem] border border-[var(--sage-green)] overflow-hidden hover:shadow-2xl transition-all group">
                <div class="h-48 bg-[var(--sage-green)]/30 flex items-center justify-center relative overflow-hidden">
                    <span class="text-6xl group-hover:scale-110 transition-transform duration-500">
                        @if($product->category === 'seeds') 🌱 @elseif($product->category === 'fertilizers') 🧪 @else 🚜 @endif
                    </span>
                    <div class="absolute top-4 right-4 bg-white/80 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest text-[var(--forest-green)]">
                        {{ $product->category }}
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-heading text-2xl text-[var(--forest-green)]">{{ $product->name }}</h3>
                        <span class="text-[var(--earth-brown)] font-bold text-xl">${{ number_format($product->price, 2) }}</span>
                    </div>
                    
                    <p class="text-sm text-gray-500 mb-6 line-clamp-2 italic">"{{ $product->description }}"</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
                        <div class="text-xs">
                            <p class="text-gray-400">Supplier</p>
                            <p class="font-bold text-[var(--forest-green)]">{{ $product->user->name }}</p>
                        </div>
                        
                        @if(auth()->user()->role === 'farmer')
                            <form action="{{ route('products.buy', $product) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bg-[var(--forest-green)] text-white p-3 rounded-full hover:bg-[var(--earth-brown)] transition-colors shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-gray-400 italic">No products available at the moment.</p>
            </div>
        @endforelse
    </div>
</x-app-layout>
