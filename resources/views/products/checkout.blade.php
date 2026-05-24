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
                            
                            <div class="grid grid-cols-2 gap-4">
                                <button type="submit" name="payment_method" value="razorpay" class="w-full bg-forest text-cream py-6 rounded-3xl font-bold text-[10px] uppercase tracking-[0.2em] border border-forest hover:bg-forest/90 transition-all shadow-xl">
                                    BUY ONLINE
                                </button>
                                <button type="submit" name="payment_method" value="Harvest Link" class="w-full bg-transparent text-forest py-6 rounded-3xl font-bold text-[10px] uppercase tracking-[0.2em] border border-forest/20 hover:bg-forest/5 transition-all shadow-md">
                                    CASH ON DELIVERY
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
