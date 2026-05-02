<x-app-layout>
    <x-slot name="header">
        Welcome back, {{ auth()->user()->name }}
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Status Card -->
        <div class="col-span-1 md:col-span-2 bg-[var(--forest-green)] text-white p-10 rounded-[2.5rem] shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <h3 class="font-heading text-3xl mb-4">You are currently logged in as a <span class="italic text-[var(--sage-green)] capitalize">{{ auth()->user()->role }}</span>.</h3>
                <p class="text-[var(--sage-green)] opacity-80 mb-8 max-w-md">
                    @if(auth()->user()->role === 'farmer')
                        Help us grow the community! Explore the marketplace to find the best inputs for your farm.
                    @else
                        Your contributions help farmers succeed. Manage your inventory and ensure high-quality supplies are available.
                    @endif
                </p>
                <a href="{{ route('products.index') }}" class="inline-block bg-[var(--earth-brown)] text-white px-8 py-4 rounded-full font-bold hover:bg-white hover:text-[var(--forest-green)] transition-all">
                    Visit Marketplace
                </a>
            </div>
            <!-- Decorative SVG -->
            <svg class="absolute bottom-0 right-0 w-64 h-64 opacity-10 translate-x-1/4 translate-y-1/4" fill="currentColor" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path d="M45.7,-76.4C58.9,-69.3,68.9,-54.6,76.5,-40.1C84.1,-25.6,89.3,-11.3,87.6,2.2C85.8,15.7,77,28.4,67.6,39.6C58.2,50.8,48.2,60.5,36.1,68.6C24,76.7,9.8,83.2,-4.2,88.9C-18.2,94.6,-32.4,99.5,-44.7,93.9C-57,88.3,-67.4,72.2,-74.6,56.1C-81.8,40,-85.8,24,-86.6,8.2C-87.4,-7.6,-85.1,-23.2,-77.8,-36.5C-70.5,-49.8,-58.3,-60.8,-44.6,-67.5C-30.9,-74.2,-15.5,-76.6,0.6,-77.5C16.7,-78.4,32.5,-83.5,45.7,-76.4Z" transform="translate(100 100)" />
            </svg>
        </div>

        <!-- Quick Stats Card -->
        <div class="bg-white p-10 rounded-[2.5rem] border border-[var(--sage-green)] flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">Quick Overview</h4>
                @php
                    $stat_label = auth()->user()->role === 'farmer' ? 'Total Orders' : 'Active Listings';
                    $stat_count = auth()->user()->role === 'farmer' ? \App\Models\Order::where('user_id', auth()->id())->count() : \App\Models\Product::where('user_id', auth()->id())->count();
                @endphp
                <div class="mb-4">
                    <span class="text-6xl font-heading text-[var(--forest-green)]">{{ $stat_count }}</span>
                    <p class="text-gray-500 font-medium">{{ $stat_label }}</p>
                </div>
            </div>
            <div class="pt-6 border-t border-gray-100">
                <p class="text-sm text-gray-400">Account Type</p>
                <p class="font-bold text-[var(--forest-green)] capitalize">{{ auth()->user()->role }} Account</p>
            </div>
        </div>
    </div>

    <!-- Additional Feature: Recent Activity -->
    <div class="mt-12">
        <h3 class="font-heading text-2xl text-[var(--forest-green)] mb-6">Recent Activity</h3>
        <div class="bg-white rounded-[2rem] border border-[var(--sage-green)] overflow-hidden">
            @if(auth()->user()->role === 'farmer')
                @php $orders = \App\Models\Order::with('product')->where('user_id', auth()->id())->latest()->take(5)->get(); @endphp
                <table class="w-full text-left">
                    <thead class="bg-[var(--sage-green)]/30">
                        <tr>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Product</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Quantity</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Total Price</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-8 py-6 font-bold text-[var(--forest-green)]">{{ $order->product->name }}</td>
                                <td class="px-8 py-6">{{ $order->quantity }}</td>
                                <td class="px-8 py-6 font-bold">${{ number_format($order->total_price, 2) }}</td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-amber-100 text-amber-700">
                                        {{ $order->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">No recent orders.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                @php $products = \App\Models\Product::where('user_id', auth()->id())->latest()->take(5)->get(); @endphp
                <table class="w-full text-left">
                    <thead class="bg-[var(--sage-green)]/30">
                        <tr>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Product</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Price</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Stock</th>
                            <th class="px-8 py-4 text-xs font-bold uppercase tracking-widest text-[var(--forest-green)]">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($products as $product)
                            <tr>
                                <td class="px-8 py-6 font-bold text-[var(--forest-green)]">{{ $product->name }}</td>
                                <td class="px-8 py-6">${{ number_format($product->price, 2) }}</td>
                                <td class="px-8 py-6">{{ $product->stock_quantity }}</td>
                                <td class="px-8 py-6">
                                    <a href="#" class="text-[var(--earth-brown)] font-bold hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">No products listed.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
