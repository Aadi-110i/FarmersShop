<x-app-layout>
    <x-slot name="header">
        Your <span class="text-gold italic">Provisions</span> Cart
    </x-slot>

    <div class="max-w-7xl mx-auto py-12">
        @if(empty($cartProducts))
            <div class="text-center py-40 bg-white/40 rounded-[4rem] border border-dashed border-forest/10 premium-shadow">
                <div class="w-24 h-24 bg-forest/5 rounded-full flex items-center justify-center mx-auto mb-10">
                    <svg class="w-10 h-10 text-forest/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="font-heading text-3xl text-forest/40 italic mb-10">Your collection is currently empty.</p>
                <a href="{{ route('products.index') }}" class="bg-forest text-gold px-12 py-6 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:bg-gold hover:text-forest transition-all shadow-2xl shadow-forest/20 inline-flex items-center gap-4 group">
                    Begin Exploration
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-8">
                    @foreach($cartProducts as $item)
                        <div class="bg-white/40 backdrop-blur-xl rounded-[3rem] border border-forest/5 p-8 flex flex-col md:flex-row gap-10 items-center premium-shadow group">
                            <div class="w-40 h-40 rounded-[2rem] overflow-hidden flex-shrink-0 bg-forest/5 border border-forest/5">
                                <img src="{{ $item['product']->image_url }}" 
                                     alt="{{ $item['product']->name }}" 
                                     class="w-full h-full object-cover grayscale-[0.2] group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700"
                                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=800';">
                            </div>
                            
                            <div class="flex-grow text-center md:text-left">
                                <div class="flex flex-col gap-1 mb-6">
                                    <span class="text-[9px] font-bold uppercase tracking-[0.3em] text-gold">{{ $item['product']->category }}</span>
                                    <h3 class="font-heading text-3xl text-forest">{{ $item['product']->name }}</h3>
                                </div>
                                
                                <div class="flex items-center justify-center md:justify-start gap-8">
                                    <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center gap-4 bg-forest/5 px-6 py-3 rounded-full border border-forest/5">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock_quantity }}" 
                                               class="w-12 bg-transparent border-none p-0 focus:ring-0 text-center font-bold text-forest text-sm">
                                        <button type="submit" class="text-gold hover:text-forest font-black text-[9px] uppercase tracking-widest transition-colors">Update</button>
                                    </form>

                                    <form action="{{ route('cart.remove', $item['product']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-full border border-red-100 text-red-300 hover:bg-red-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="text-center md:text-right border-t md:border-t-0 md:border-l border-forest/5 pt-6 md:pt-0 md:pl-10">
                                <p class="text-[9px] text-forest/30 font-bold uppercase tracking-widest mb-1">Subtotal</p>
                                <p class="text-forest font-light italic text-3xl">₹{{ number_format($item['subtotal'], 0) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Checkout Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-forest text-cream rounded-[4rem] p-12 shadow-2xl sticky top-32 overflow-hidden relative">
                        <!-- Decorative background light -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gold/10 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2"></div>
                        
                        <div class="relative z-10">
                            <h2 class="font-heading text-4xl mb-12">Manifest</h2>
                            
                            <div class="space-y-6 mb-12">
                                <div class="flex justify-between items-center border-b border-cream/5 pb-6">
                                    <span class="text-cream/40 text-[10px] font-bold uppercase tracking-widest">Valuation</span>
                                    <span class="font-light italic text-2xl">₹{{ number_format($total, 0) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-2">
                                    <span class="text-cream/40 text-[10px] font-bold uppercase tracking-widest">Logistics</span>
                                    <span class="text-gold font-bold text-[10px] uppercase tracking-[0.2em]">Complimentary</span>
                                </div>
                            </div>

                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <div class="mb-12">
                                    <label class="block text-[9px] font-black uppercase tracking-[0.3em] text-cream/30 mb-8">Settlement Method</label>
                                    <div class="space-y-4">
                                        @foreach(['cod' => 'Estate Collection (COD)', 'upi' => 'Digital Transfer (UPI)', 'card' => 'Institutional Card'] as $val => $label)
                                            <label class="flex items-center gap-4 p-5 rounded-[1.5rem] bg-white/5 border border-white/5 cursor-pointer hover:bg-white/10 transition-all group">
                                                <input type="radio" name="payment_method" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} class="text-gold focus:ring-gold bg-transparent border-white/20">
                                                <span class="text-[10px] font-bold uppercase tracking-widest text-cream/70 group-hover:text-cream">{{ $label }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-gold text-forest py-6 rounded-full font-bold text-xs uppercase tracking-[0.2em] hover:scale-105 transition-all shadow-2xl shadow-black/40">
                                    Finalize Acquisition
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
