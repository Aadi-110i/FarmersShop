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
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="flex text-gold">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-forest/40">({{ $product->review_count }} Reviews)</span>
                </div>
                
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
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-4">
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow">
                                @csrf
                                <button type="submit" class="w-full border-2 border-forest text-forest px-12 py-6 rounded-full hover:bg-forest hover:text-gold transition-all flex items-center justify-center gap-4 group/btn">
                                    <span class="text-xs font-bold uppercase tracking-[0.3em]">Add to Collection</span>
                                </button>
                            </form>
                            <a href="{{ route('products.checkout', $product) }}" class="flex-grow bg-forest text-gold px-12 py-6 rounded-full hover:bg-gold hover:text-forest transition-all shadow-2xl flex items-center justify-center gap-4 group/btn">
                                <span class="text-xs font-bold uppercase tracking-[0.3em]">Buy Now</span>
                                <svg class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @elseif(auth()->id() === $product->user_id)
                    <div class="bg-forest/5 rounded-3xl p-8 border border-forest/5">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-forest/40 italic">You are the steward of this provision.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-40 grid grid-cols-1 lg:grid-cols-3 gap-20">
            <div class="lg:col-span-1">
                <h2 class="font-heading text-4xl text-forest mb-8">Community <span class="text-gold italic">Ledger</span></h2>
                <div class="bg-forest/5 rounded-[3rem] p-10 border border-forest/5">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-forest/20 mb-6">Aggregate Rating</p>
                    <div class="flex items-end gap-4 mb-6">
                        <span class="text-7xl font-heading text-forest leading-none">{{ number_format($product->average_rating, 1) }}</span>
                        <div class="flex text-gold mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= round($product->average_rating) ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-forest/40">Based on {{ $product->review_count }} verified accounts</p>
                </div>

                @auth
                <div class="mt-12 pt-12 border-t border-forest/5">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-forest/30 mb-8">Submit Your Account</h3>
                    <form action="{{ route('reviews.store', $product) }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-forest/40 mb-3 block">Rating Index</label>
                            <div class="flex gap-2">
                                @for($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="rating" value="{{ $i }}" class="sr-only peer" {{ $i == 5 ? 'checked' : '' }}>
                                    <div class="w-10 h-10 rounded-xl bg-forest/5 flex items-center justify-center text-forest/20 group-hover:bg-forest/10 peer-checked:bg-forest peer-checked:text-gold transition-all text-xs font-bold">
                                        {{ $i }}
                                    </div>
                                </label>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <label class="text-[9px] font-black uppercase tracking-[0.2em] text-forest/40 mb-3 block">Observation</label>
                            <textarea name="comment" rows="4" class="w-full bg-forest/5 border-none rounded-3xl p-6 text-sm text-forest placeholder:text-forest/20 focus:ring-2 focus:ring-gold/20 transition-all" placeholder="Your ecological findings..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-forest text-gold px-8 py-4 rounded-full text-[10px] font-bold uppercase tracking-widest hover:bg-gold hover:text-forest transition-all">
                            Post to Ledger
                        </button>
                    </form>
                </div>
                @endauth
            </div>

            <div class="lg:col-span-2 space-y-8">
                @forelse($product->reviews as $review)
                <div class="bg-cream/50 backdrop-blur-sm rounded-[3rem] p-12 border border-forest/5 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-forest text-gold flex items-center justify-center text-[10px] font-black italic">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest text-forest">{{ $review->user->name }}</p>
                                <p class="text-[9px] font-bold text-forest/30 uppercase tracking-[0.2em] mt-1">{{ $review->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex text-gold">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-forest/70 italic text-lg leading-relaxed">"{{ $review->comment }}"</p>
                </div>
                @empty
                <div class="py-20 text-center border-2 border-dashed border-forest/5 rounded-[3rem]">
                    <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-forest/20">No accounts recorded in the ledger yet.</p>
                </div>
                @endforelse
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
