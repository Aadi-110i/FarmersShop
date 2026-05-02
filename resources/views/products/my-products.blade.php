<x-app-layout>
    <x-slot name="header">
        My Inventory
    </x-slot>

    <div class="mb-12 flex justify-between items-center">
        <p class="text-gray-600">Manage the products you've listed on TerraMarket.</p>
        <a href="{{ route('products.create') }}" class="bg-[var(--earth-brown)] text-white px-6 py-3 rounded-full font-bold hover:bg-[var(--forest-green)] transition-all shadow-lg">
            List New Product
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] border border-[var(--sage-green)] overflow-hidden shadow-xl shadow-[var(--forest-green)]/5">
        <table class="w-full text-left">
            <thead class="bg-[var(--sage-green)]/30">
                <tr>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Product</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Category</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Price</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Stock</th>
                    <th class="px-8 py-5 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)] text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-[var(--sage-green)]/10 transition-colors">
                        <td class="px-8 py-6">
                            <p class="font-bold text-[var(--forest-green)] text-lg">{{ $product->name }}</p>
                        </td>
                        <td class="px-8 py-6 capitalize text-sm font-medium text-gray-500">{{ $product->category }}</td>
                        <td class="px-8 py-6 font-bold text-[var(--earth-brown)]">${{ number_format($product->price, 2) }}</td>
                        <td class="px-8 py-6 text-sm font-bold">{{ $product->stock_quantity }} units</td>
                        <td class="px-8 py-6 text-right">
                            <button class="text-gray-400 hover:text-[var(--forest-green)] transition-colors">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-gray-400 italic">You haven't listed any products yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
