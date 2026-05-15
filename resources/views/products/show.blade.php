<x-app-layout>
    <x-slot name="header">
        Product <span class="text-gold italic">Intelligence</span>
    </x-slot>

    <div class="container mx-auto px-4 py-12">
        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-forest/40 hover:text-forest font-bold text-[10px] uppercase tracking-[0.2em] mb-12 transition-colors group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Collection
        </a>

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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <!-- Product Visual -->
            <div class="relative group">
                <div class="aspect-square rounded-[4rem] overflow-hidden bg-forest/5 premium-shadow border border-forest/5 relative">
                    <img src="{{ $imgSrc }}" 
                         class="w-full h-full object-cover grayscale-[0.1] group-hover:grayscale-0 transition-all duration-1000" 
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=1200';">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-forest/40 to-transparent opacity-30"></div>
                </div>

                <!-- Floating Badge -->
                <div class="absolute -bottom-10 -right-10 bg-cream/90 backdrop-blur-xl p-10 rounded-[3rem] border border-forest/10 shadow-2xl max-w-[240px] animate-float">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-forest/20 mb-4">Stock Availability</p>
                    <p class="text-4xl font-heading text-forest mb-2">{{ $product->stock_quantity }}</p>
                    <p class="text-[9px] font-bold uppercase tracking-widest text-gold italic">Units in Estate</p>
                </div>
            </div>

            <!-- Product Details -->
            <div class="pt-10">
                <div class="inline-block px-5 py-2 rounded-full bg-forest/5 text-forest text-[9px] font-black uppercase tracking-[0.3em] mb-8 border border-forest/5">
                    {{ $product->category }}
                </div>
                
                <h1 class="font-heading text-6xl text-forest mb-6 leading-none">{{ $product->name }}</h1>
                
                <div class="flex items-center gap-6 mb-12">
                    <span class="text-4xl font-light text-gold italic">₹{{ number_format($product->price, 0) }}</span>
                    <div class="h-8 w-px bg-forest/10"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-forest text-gold flex items-center justify-center text-[9px] font-black italic">
                            {{ substr($product->user->name, 0, 1) }}
                        </div>
                        <p class="text-[10px] font-bold uppercase tracking-widest text-forest/40">Steward: {{ $product->user->name }}</p>
                    </div>
                </div>

                <div class="prose prose-forest mb-16">
                    <p class="text-xl text-forest/60 italic leading-relaxed font-medium">
                        "{{ $product->description }}"
                    </p>
                </div>

                <!-- Specifications / Meta -->
                <div class="grid grid-cols-2 gap-8 mb-16 border-t border-b border-forest/5 py-12">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.3em] text-forest/30 mb-2">Category</p>
                        <p class="font-bold text-forest text-sm uppercase tracking-widest">{{ $product->category }}</p>
                    </div>
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.3em] text-forest/30 mb-2">Product ID</p>
                        <p class="font-bold text-forest text-sm uppercase tracking-widest">TR-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>

                @if(auth()->user()->role === 'farmer')
                    <div class="flex items-center gap-6">
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow">
                            @csrf
                            <button type="submit" class="w-full bg-forest text-gold px-12 py-6 rounded-full hover:bg-gold hover:text-forest transition-all shadow-2xl flex items-center justify-center gap-4 group/btn">
                                <span class="text-xs font-bold uppercase tracking-[0.3em]">Acquire Provision</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-y-[-2px] transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                @elseif(auth()->id() === $product->user_id)
                    <div class="bg-forest/5 rounded-3xl p-8 border border-forest/5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-forest/40 italic">You are the steward of this provision.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Related/Bottom Section (Optional) -->
        <div class="mt-40 pt-20 border-t border-forest/5">
            <h2 class="font-heading text-4xl text-forest mb-12">Environmental <span class="text-gold italic">Context</span></h2>
            <div class="bg-forest rounded-[3rem] p-16 text-cream relative overflow-hidden">
                <div class="relative z-10 max-w-2xl">
                    <p class="text-sm uppercase font-black tracking-[0.3em] mb-6 opacity-40">Sustainable Sourcing</p>
                    <p class="text-3xl font-medium leading-relaxed italic mb-8">
                        Every product in the Terra collection is vetted for ecological integrity and local impact.
                    </p>
                    <a href="{{ route('products.index') }}" class="text-gold font-bold uppercase tracking-widest text-[10px] underline underline-offset-8">Browse full estate</a>
                </div>
                <!-- Abstract patterns in background -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-gold/5 rounded-full blur-[100px] -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-sage/5 rounded-full blur-[80px] -ml-32 -mb-32"></div>
            </div>
        </div>
    </div>
</x-app-layout>
