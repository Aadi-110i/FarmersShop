<x-app-layout>
    <x-slot name="header">
        Secure <span class="text-gold italic">Provisions</span>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <a href="{{ route('products.show', $product) }}" class="inline-flex items-center gap-2 text-forest/40 hover:text-forest font-bold text-[10px] uppercase tracking-[0.2em] mb-12 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Provision
        </a>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Order Summary -->
                <div class="bg-forest rounded-[3rem] p-12 text-cream relative overflow-hidden h-fit">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em] mb-12 opacity-40">Provision Summary</h2>
                    
                    <div class="flex items-center gap-6 mb-12 pb-12 border-b border-cream/10">
                        @php
                            $image_map = [
                                'grainop' => '/images/products/grainop.png',
                                'grain' => '/images/products/grain.png',
                                'mustard' => '/images/products/mustard.png',
                                'cotton' => '/images/products/cotton.png',
                                'sprayer' => '/images/products/sprayer.png',
                                'seeder' => '/images/products/seeder.png',
                                'rake' => '/images/products/rake.png',
                                'pickaxe' => '/images/products/pickaxe.png',
                                'spade' => '/images/products/sprayer.png',
                            ];

                            $name = strtolower($product->name);
                            $imgSrc = null;
                            foreach ($image_map as $key => $url) {
                                if (str_contains($name, $key)) {
                                    $imgSrc = $url;
                                    break;
                                }
                            }

                            if (!$imgSrc) {
                                $imgSrc = str_starts_with($product->image_url, '/')
                                    ? asset($product->image_url)
                                    : $product->image_url;
                            }
                        @endphp
                        <div class="w-24 h-24 rounded-2xl overflow-hidden border border-cream/20">
                            <img src="{{ $imgSrc }}" class="w-full h-full object-cover" alt="{{ $product->name }}">
                        </div>
                        <div>
                            <p class="font-heading text-2xl text-gold">{{ $product->name }}</p>
                            <p class="text-[10px] uppercase tracking-widest opacity-60 mt-1">{{ $product->category }}</p>
                        </div>
                    </div>

                    <div class="space-y-6 mb-12">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                            <span class="opacity-40">Unit Price</span>
                            <span>₹{{ number_format($product->price, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                            <span class="opacity-40">Taxes (IGST)</span>
                            <span>₹0.00</span>
                        </div>
                        <div class="flex justify-between text-2xl font-heading mt-6 pt-6 border-t border-cream/10">
                            <span>Total</span>
                            <span class="text-gold">₹{{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>

                    <p class="text-[9px] font-bold uppercase tracking-[0.2em] opacity-30 italic leading-relaxed">
                        * All transactions are encrypted and secured through our local estate ledger.
                    </p>
                </div>

                <!-- Payment Form -->
                <div class="pt-6">
                    <h1 class="font-heading text-4xl text-forest mb-8">Acquisition <span class="text-gold italic">Ledger</span></h1>
                    
                    <form action="{{ route('products.buy', $product) }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.3em] text-forest/30 mb-6">Settlement Method</p>
                            
                            <div class="grid grid-cols-1 gap-4">
                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="payment_method" value="Estate Credit" class="peer sr-only" checked>
                                    <div class="p-6 rounded-3xl border border-forest/5 bg-forest/5 group-hover:bg-forest/10 transition-all peer-checked:border-gold peer-checked:bg-forest peer-checked:text-cream">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center group-peer-checked:bg-gold/20">
                                                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Estate Credit Card</span>
                                            </div>
                                            <div class="w-4 h-4 rounded-full border-2 border-forest/10 peer-checked:border-gold flex items-center justify-center">
                                                <div class="w-2 h-2 rounded-full bg-gold opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="payment_method" value="UPI Settlement" class="peer sr-only">
                                    <div class="p-6 rounded-3xl border border-forest/5 bg-forest/5 group-hover:bg-forest/10 transition-all peer-checked:border-gold peer-checked:bg-forest peer-checked:text-cream">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">UPI Settlement</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative block group cursor-pointer">
                                    <input type="radio" name="payment_method" value="Harvest Link" class="peer sr-only">
                                    <div class="p-6 rounded-3xl border border-forest/5 bg-forest/5 group-hover:bg-forest/10 transition-all peer-checked:border-gold peer-checked:bg-forest peer-checked:text-cream">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                                </div>
                                                <span class="text-[10px] font-black uppercase tracking-widest">Harvest Link (COD)</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="pt-8">
                            <button type="submit" class="w-full bg-forest text-gold px-12 py-6 rounded-full hover:bg-gold hover:text-forest transition-all shadow-2xl flex items-center justify-center gap-4 group/btn">
                                <span class="text-xs font-bold uppercase tracking-[0.3em]">Confirm Settlement</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
