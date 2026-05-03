<x-app-layout>
    <x-slot name="header">
        My Inventory
    </x-slot>

    <div class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <p class="text-gray-600 font-medium">Manage and track the performance of your agricultural listings.</p>
        </div>
        <a href="{{ route('products.create') }}" class="bg-earth text-white px-8 py-4 rounded-full font-bold hover:bg-forest transition-all shadow-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            List New Product
        </a>
    </div>

    <div class="bg-white rounded-[3rem] border border-sage/50 overflow-hidden shadow-xl shadow-forest/5">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-sage/10">
                    <tr>
                        <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest">Product Details</th>
                        <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest">Category</th>
                        <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest">Pricing</th>
                        <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest">Stock Status</th>
                        <th class="px-10 py-6 text-[10px] font-bold uppercase tracking-[0.2em] text-forest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sage/10">
                    @forelse($products as $product)
                        <tr class="hover:bg-sage/5 transition-colors group">
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-6">
                                    <div class="w-20 h-20 rounded-2xl overflow-hidden shadow-md flex-shrink-0 border-2 border-white">
                                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=200' }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                             alt="{{ $product->name }}">
                                    </div>
                                    <div>
                                        <p class="font-heading text-xl text-forest">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-400 font-medium line-clamp-1 max-w-[200px]">{{ $product->description }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-10 py-8">
                                <span class="px-4 py-1.5 rounded-full bg-sage/20 text-forest text-[10px] font-bold uppercase tracking-widest border border-forest/5">
                                    {{ $product->category }}
                                </span>
                            </td>
                            <td class="px-10 py-8 font-bold text-earth text-xl">₹{{ number_format($product->price, 0) }}</td>
                            <td class="px-10 py-8">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $product->stock_quantity > 50 ? 'bg-green-500' : 'bg-amber-500' }}"></div>
                                    <span class="font-bold text-forest text-sm">{{ $product->stock_quantity }} <span class="text-gray-400 font-medium">units left</span></span>
                                </div>
                            </td>
                            <td class="px-10 py-8 text-right">
                                <button class="p-3 text-gray-400 hover:text-forest transition-colors hover:bg-white rounded-xl shadow-sm border border-transparent hover:border-sage/20">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-10 py-32 text-center text-gray-400 italic font-medium">You haven't listed any products yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
