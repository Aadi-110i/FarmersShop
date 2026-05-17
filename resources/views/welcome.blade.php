<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terra - Agricultural Marketplace</title>

    <!-- Google Fonts: Fraunces & DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@SOFT@9..144,300..900,50..100&display=swap" rel="stylesheet">

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        forest: '#1C3F2B',
                        sage: '#E4EBE5',
                        earth: '#8C6A53',
                        sunlight: '#FDF9EC',
                    },
                    fontFamily: {
                        heading: ['Fraunces', 'serif'],
                        sans: ['DM Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #FDF9EC;
        }
        
        /* --- KINETIC TYPOGRAPHY PRELOADER --- */
        #page-preloader {
            position: fixed;
            inset: 0;
            background-color: #1C3F2B; /* Deep Forest */
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: #FDF9EC;
        }

        .loader-shutter {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            z-index: 1;
        }

        .shutter-row {
            flex: 1;
            background: #1C3F2B;
            width: 100%;
            transform-origin: left;
        }

        .loader-content-wrap {
            position: relative;
            z-index: 10;
            perspective: 1000px;
        }

        .kinetic-text {
            font-family: 'Fraunces', serif;
            font-size: 8vw;
            line-height: 1;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            display: flex;
            overflow: hidden;
        }

        .kinetic-text span {
            display: block;
            transform: translateY(100%);
        }

        .loader-progress {
            position: absolute;
            bottom: 15%;
            left: 10%;
            right: 10%;
            height: 1px;
            background: rgba(253, 249, 236, 0.1);
        }

        .progress-bar {
            height: 100%;
            background: #8C6A53; /* Earth Gold */
            width: 0%;
        }

        @media (prefers-reduced-motion: reduce) {
            #page-preloader { display: none !important; }
        }

        /* Site Content Styles */
        .hero-image {
            background-image: linear-gradient(rgba(28, 63, 43, 0.2), rgba(28, 63, 43, 0.4)), url('https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?auto=format&fit=crop&q=80&w=1200');
            background-size: cover;
            background-position: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
    </style>
</head>
<body class="antialiased text-[#2D3A33] font-sans">

    <!-- Unique Kinetic Typography Preloader -->
    <div id="page-preloader" role="status" aria-label="Loading TerraMarket">
        <div class="loader-shutter">
            <div class="shutter-row"></div>
            <div class="shutter-row"></div>
            <div class="shutter-row"></div>
        </div>
        
        <div class="loader-content-wrap">
            <h1 class="kinetic-text">
                <span>T</span>
                <span>E</span>
                <span>R</span>
                <span>R</span>
                <span>A</span>
            </h1>
        </div>

        <div class="loader-progress">
            <div class="progress-bar"></div>
        </div>
    </div>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Content Wrapper for Reveal -->
    <div id="site-content" style="opacity: 0;">
    <!-- NAV -->
    <nav class="relative z-50 container mx-auto px-6 py-8 flex justify-between items-center">
        <a href="/" class="group">
            <x-application-logo />
        </a>
        
        <div class="space-x-8 flex items-center">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-bold text-forest hover:text-earth transition-colors">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-bold text-forest hover:text-earth transition-colors">Log in</a>
                <a href="{{ route('register') }}" class="bg-forest text-white px-8 py-3.5 rounded-full font-bold hover:shadow-xl transition-all">Join Network</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION -->
    <header class="relative pt-10 pb-20 overflow-hidden">
        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="relative z-20 hero-content">
                <div class="inline-block px-4 py-1.5 rounded-full bg-sage text-forest text-xs font-bold uppercase tracking-widest mb-6">
                    Direct Farmer-to-Supplier Trade
                </div>
                <h1 class="text-6xl lg:text-8xl font-heading text-forest leading-[0.95] mb-8">
                    Rooted in <br> <span class="italic text-earth">Quality.</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10 leading-relaxed max-w-lg">
                    Access premium seeds, fertilizers, and tools. We connect you directly with local suppliers for transparent pricing and thriving yields.
                </p>
                <div class="flex flex-wrap gap-5">
                    <a href="{{ route('register') }}" class="bg-earth text-white px-10 py-5 rounded-full font-bold text-lg hover:-translate-y-1 transition-transform shadow-2xl shadow-earth/30">
                        Explore Inputs
                    </a>
                    <a href="#featured" class="px-10 py-5 rounded-full font-bold text-lg text-forest border-2 border-forest hover:bg-sage transition-colors">
                        View Products
                    </a>
                </div>
            </div>

            <!-- REAL NATURE SCENERY -->
            <div class="relative w-full h-[600px] rounded-[4rem] overflow-hidden shadow-2xl hero-image">
                <!-- Floating Product Info Card -->
                <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                    <div class="glass-card p-10 rounded-[3rem] w-80 animate-float shadow-xl pointer-events-auto">
                        <div class="bg-forest/10 w-16 h-16 rounded-2xl flex items-center justify-center text-4xl mb-6">🌱</div>
                        <h3 class="font-heading text-2xl text-forest mb-2">Organic Wheat</h3>
                        <p class="text-sm text-gray-700 mb-4">Certified Grade A Seeds</p>
                        <div class="flex items-center justify-between border-t border-white/30 pt-4">
                            <span class="font-bold text-xl text-earth">₹1,250</span>
                            <span class="text-xs font-bold uppercase tracking-widest opacity-60">Verified</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>

    <!-- FEATURED PRODUCTS -->
    <section id="featured" class="py-32 bg-forest text-sunlight relative">
        <!-- Mountain Divider -->
        <svg viewBox="0 0 1440 120" class="absolute top-0 left-0 w-full -translate-y-[99%]" preserveAspectRatio="none">
            <path fill="#1C3F2B" d="M0,64L80,58.7C160,53,320,43,480,48C640,53,800,75,960,80C1120,85,1280,75,1360,69.3L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>

        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div>
                    <h2 class="font-heading text-5xl mb-4">Fresh in the Market</h2>
                    <p class="text-sage opacity-70 max-w-md">Our latest agricultural inputs sourced from top-tier local suppliers.</p>
                </div>
                <a href="{{ route('register') }}" class="text-earth bg-sunlight px-8 py-3 rounded-full font-bold hover:bg-sage transition-colors">Browse All Products</a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php 
                    // Mock data to bypass the "could not find driver" error for UI testing
                    try {
                        $products = \App\Models\Product::with('user')->take(4)->get(); 
                    } catch (\Exception $e) {
                        $products = collect([
                            (object)[
                                'id' => 1,
                                'name' => 'Hybrid Basmati Grains',
                                'price' => 1250.00,
                                'image_url' => '/images/products/seed_basmati.png',
                                'description' => 'Long-grain high-aroma rice grains for sowing.',
                                'category' => 'Seeds',
                                'stock_quantity' => 250,
                                'average_rating' => 4.8,
                                'review_count' => 12,
                                'user' => (object)['name' => 'Aadarsh Sharma']
                            ],
                            (object)[
                                'id' => 2,
                                'name' => 'Golden Wheat Grains',
                                'price' => 850.00,
                                'image_url' => '/images/products/seed_wheat.png',
                                'description' => 'Premium hard wheat seeds for high yield.',
                                'category' => 'Seeds',
                                'stock_quantity' => 450,
                                'average_rating' => 4.5,
                                'review_count' => 8,
                                'user' => (object)['name' => 'Aadarsh Sharma']
                            ],
                            (object)[
                                'id' => 3,
                                'name' => 'Yellow Mustard Seeds',
                                'price' => 450.00,
                                'image_url' => '/images/products/seed_mustard.png',
                                'description' => 'High oil content traditional mustard seeds.',
                                'category' => 'Seeds',
                                'stock_quantity' => 120,
                                'average_rating' => 4.2,
                                'review_count' => 5,
                                'user' => (object)['name' => 'Aadarsh Sharma']
                            ],
                            (object)[
                                'id' => 4,
                                'name' => 'Pure Cotton Pod Seeds',
                                'price' => 1400.00,
                                'image_url' => '/images/products/seed_cotton.png',
                                'description' => 'Verified cotton seeds with high pest resistance.',
                                'category' => 'Seeds',
                                'stock_quantity' => 85,
                                'average_rating' => 4.9,
                                'review_count' => 15,
                                'user' => (object)['name' => 'Aadarsh Sharma']
                            ]
                        ]);
                    }

                    $image_map = [
                        'grainop' => '/images/products/grainop.png',
                        'grain' => '/images/products/grain.png',
                        'mustard' => '/images/products/mustard.png',
                        'cotton' => '/images/products/cotton.png',
                        'sprayer' => '/images/products/sprayer.png',
                        'seeder' => '/images/products/seeder.png',
                        'rake' => '/images/products/rake.png',
                        'pickaxe' => '/images/products/pickaxe.png',
                        'default' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800&auto=format&fit=crop'
                    ];
                @endphp
                @foreach($products as $product)
                    @php
                        $name = strtolower($product->name);
                        $category = strtolower($product->category);
                        
                        // Broad override map for agricultural products
                        $override_map = [
                            'basmati' => '/images/products/seed_basmati.png',
                            'wheat' => '/images/products/seed_wheat.png',
                            'mustard' => '/images/products/seed_mustard.png',
                            'cotton' => '/images/products/seed_cotton.png',
                            'corn' => '/images/products/seed_corn.png',
                            'tomato' => '/images/products/seed_tomato.png',
                            'sunflower' => 'https://images.unsplash.com/photo-1597848212624-a19eb35e2e47?q=80&w=800&auto=format&fit=crop',
                            'manure' => 'https://images.unsplash.com/photo-1592982537447-6f2a6a0c7c18?q=80&w=800&auto=format&fit=crop',
                            'compost' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=800&auto=format&fit=crop',
                            'sprayer' => '/images/products/sprayer.png',
                            'seeder' => '/images/products/seeder.png',
                            'rake' => '/images/products/rake.png',
                            'pickaxe' => '/images/products/pickaxe.png',
                            'spade' => '/images/products/sprayer.png',
                        ];

                        $img_url = null;
                        foreach ($override_map as $key => $url) {
                            if (str_contains($name, $key)) {
                                $img_url = $url;
                                break;
                            }
                        }

                        // Use database image_url if no keyword match is found
                        if (!$img_url && !empty($product->image_url)) {
                            $img_url = $product->image_url;
                        }

                        // Category-based fallback if still null
                        // Category-based fallback if still null
                        if (!$img_url) {
                            $category_defaults = [
                                'seeds' => 'https://images.unsplash.com/photo-1597848212624-a19eb35e2e47?q=80&w=800&auto=format&fit=crop',
                                'manures' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=800&auto=format&fit=crop',
                                'fertilizers' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?q=80&w=800&auto=format&fit=crop',
                                'tools' => 'https://images.unsplash.com/photo-1589923188900-85dae523342b?q=80&w=800&auto=format&fit=crop',
                            ];
                            $img_url = $category_defaults[$category] ?? 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=800&auto=format&fit=crop';
                        }

                        // Final resolution for relative paths
                        if (str_starts_with($img_url, '/')) {
                            $img_url = asset($img_url);
                        }
                    @endphp
                    <!-- v2.2 Visual Deployment Check -->
                    <a href="{{ auth()->check() ? route('products.show', $product->id ?? 1) : route('login') }}" class="bg-white border border-forest/5 rounded-[3rem] hover:shadow-2xl transition-all group overflow-hidden relative flex flex-col premium-shadow">
                        <!-- Product Image -->
                        <div class="h-64 w-full overflow-hidden relative bg-forest/5">
                            <img src="{{ $img_url }}" 
                                 class="w-full h-full object-cover grayscale-[0.1] group-hover:grayscale-0 group-hover:scale-105 transition-all duration-1000" 
                                 alt="{{ $product->name }}">
                            <div class="absolute top-6 left-6 bg-cream/90 backdrop-blur-md px-4 py-1.5 rounded-full text-[8px] font-black uppercase tracking-[0.2em] text-forest border border-forest/5">
                                {{ $product->category }}
                            </div>
                        </div>

                        <div class="p-10 flex-grow">
                            <div class="flex justify-between items-start mb-4">
                                <h4 class="font-heading text-3xl text-forest leading-tight group-hover:text-earth transition-colors">{{ $product->name }}</h4>
                                <span class="text-earth font-light italic text-2xl">₹{{ number_format($product->price, 0) }}</span>
                            </div>

                            <div class="flex items-center gap-2 mb-6">
                                <div class="flex text-gold">
                                    @php $rating = $product->average_rating ?? 5; @endphp
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= round($rating) ? 'fill-current' : 'text-forest/10' }}" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-[8px] font-bold uppercase tracking-widest text-forest/20">({{ $product->review_count ?? 0 }})</span>
                            </div>
                            
                            <p class="text-sm text-forest/50 mb-10 line-clamp-2 italic font-medium leading-relaxed">"{{ $product->description }}"</p>
                            
                            <div class="flex items-center justify-between pt-8 border-t border-forest/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-forest text-gold flex items-center justify-center text-[8px] font-black italic">
                                        {{ substr($product->user->name ?? 'T', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-[7px] text-forest/30 font-black uppercase tracking-[0.2em] mb-0.5">Steward</p>
                                        <p class="font-bold text-forest text-[9px] uppercase tracking-widest">{{ $product->user->name ?? 'Steward' }}</p>
                                    </div>
                                </div>
                                
                                <div class="bg-forest text-gold px-6 py-3 rounded-full flex items-center gap-3">
                                    <span class="text-[8px] font-bold uppercase tracking-[0.2em]">Acquire</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SCENERY STRIP -->
    <section class="h-96 w-full relative overflow-hidden">
        <canvas id="scenery-bg" class="w-full h-full"></canvas>
        <div class="absolute inset-0 bg-forest/20 backdrop-blur-[2px] pointer-events-none"></div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-forest py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="flex items-center justify-center mb-12">
                <a href="/" class="group">
                    <div class="flex items-center gap-4">
                        <div class="relative w-14 h-14 flex items-center justify-center">
                            <div class="absolute inset-0 rounded-2xl bg-white/10 border border-white/20 rotate-45 group-hover:rotate-90 transition-transform duration-700"></div>
                            <svg class="relative w-10 h-10 text-white group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C12 22 20 18 20 12C20 6 12 2 12 2C12 2 4 6 4 12C4 18 12 22 12 22Z" fill="currentColor" fill-opacity="0.1"/>
                                <path d="M12 22V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M12 12L17 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-sunlight/40"/>
                                <path d="M12 16L16 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-sunlight/40"/>
                                <path d="M12 12L7 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-sunlight/40"/>
                                <path d="M12 16L8 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" class="text-sunlight/40"/>
                                <path d="M12 2C12 2 4 6 4 12C4 18 12 22 12 22C12 22 20 18 20 12C20 6 12 2 12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="font-heading font-black text-3xl tracking-tighter text-white leading-none uppercase">Terra</span>
                            <span class="font-sans font-bold text-[11px] tracking-[0.4em] text-sunlight/50 leading-none uppercase ml-0.5">Market</span>
                        </div>
                    </div>
                </a>
            </div>
            <p class="text-sage opacity-50 text-sm">© 2026 TerraMarket Agricultural Marketplace. All Rights Reserved.</p>
        </div>
    </footer>
    </div> <!-- End site-content -->

    <script>
        // GSAP Animation Sequence for Kinetic Typography
        const tl = gsap.timeline({
            defaults: { ease: "expo.inOut" }
        });

        window.addEventListener('load', function() {
            // 1. Progress Bar Loading
            tl.to('.progress-bar', {
                width: '100%',
                duration: 2,
                ease: "power2.inOut"
            })
            // 2. Text Stagger In
            .to('.kinetic-text span', {
                y: 0,
                duration: 1.2,
                stagger: 0.1,
                ease: "expo.out"
            }, "-=1.5")
            // 3. Text Stagger Out
            .to('.kinetic-text span', {
                y: '-100%',
                duration: 1,
                stagger: 0.05,
                delay: 0.5,
                ease: "expo.in"
            })
            // 4. Shutter Reveal
            .to('.shutter-row', {
                scaleX: 0,
                duration: 1.5,
                stagger: 0.15,
                ease: "expo.inOut"
            }, "-=0.5")
            // 5. Cleanup
            .to('#page-preloader', {
                display: 'none',
                duration: 0.1
            })
            // 6. Reveal site-content
            .to('#site-content', {
                opacity: 1,
                duration: 0.1
            }, "-=1.2")
            .from('nav', {
                y: -50,
                opacity: 0,
                duration: 1.5,
                ease: "expo.out"
            }, "-=1")
            .from('.hero-content > *', {
                y: 60,
                opacity: 0,
                duration: 1.5,
                stagger: 0.1,
                ease: "expo.out"
            }, "-=1.3");
        });
    </script>

</body>
</html>
