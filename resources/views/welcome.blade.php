<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terra - Agricultural Marketplace</title>

    <!-- Google Fonts: Fraunces & DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght,SOFT@9..144,300..900,50..100&display=swap" rel="stylesheet">

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
        }
        
        /* Preloader Styles */
        #preloader {
            position: fixed;
            inset: 0;
            background-color: #1C3F2B;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 1s ease-in-out, visibility 1s;
            overflow: hidden;
        }

        #preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .preloader-bg {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(28, 63, 43, 0.7), rgba(28, 63, 43, 0.9)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=1920');
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            transform: scale(1.1);
        }

        .loader-bar {
            width: 200px;
            height: 2px;
            background: rgba(255,255,255,0.1);
            position: relative;
            margin-top: 2rem;
            border-radius: 4px;
            overflow: hidden;
        }

        .loader-progress {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            background: #FDF9EC;
            width: 0%;
            transition: width 2s cubic-bezier(0.65, 0, 0.35, 1);
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

    <!-- Cinematic Preloader -->
    <div id="preloader">
        <div class="preloader-bg"></div>
        <div class="relative z-10 flex flex-col items-center">
            <svg class="w-20 h-20 text-sunlight mb-6 animate-pulse" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
            <h2 class="font-heading text-4xl text-sunlight tracking-widest uppercase">TerraMarket</h2>
            <div class="loader-bar">
                <div class="loader-progress" id="loader-progress"></div>
            </div>
            <p class="mt-4 text-[10px] font-bold tracking-[0.3em] text-sage opacity-50 uppercase">Cultivating your digital farm</p>
        </div>
    </div>

    <!-- NAV -->
    <nav class="relative z-50 container mx-auto px-6 py-8 flex justify-between items-center">
        <div class="flex items-center gap-2 text-forest">
            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
            <span class="font-heading font-bold text-3xl tracking-tight">TerraMarket</span>
        </div>
        
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
            
            <div class="relative z-20">
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
                            <span class="font-bold text-xl text-earth">$45.00</span>
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
                @php $products = \App\Models\Product::with('user')->take(4)->get(); @endphp
                @foreach($products as $product)
                    <div class="bg-white/5 border border-white/10 p-8 rounded-[2.5rem] hover:bg-white/10 transition-all group overflow-hidden relative">
                        <!-- Tiny background splash -->
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl group-hover:bg-earth/20 transition-all"></div>
                        
                        <div class="text-5xl mb-6 group-hover:scale-110 transition-transform duration-500 relative z-10">
                            @if($product->category == 'seeds') 🌱 @elseif($product->category == 'fertilizers') 🧪 @else 🚜 @endif
                        </div>
                        <h4 class="font-heading text-2xl mb-2 relative z-10">{{ $product->name }}</h4>
                        <p class="text-sm text-sage opacity-60 mb-6 h-10 overflow-hidden relative z-10">{{ $product->description }}</p>
                        <div class="flex items-center justify-between pt-6 border-t border-white/10 relative z-10">
                            <span class="text-xl font-bold">${{ number_format($product->price, 2) }}</span>
                            <span class="text-[10px] uppercase font-bold tracking-widest text-earth">Stock: {{ $product->stock_quantity }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SCENERY STRIP -->
    <section class="h-96 w-full relative overflow-hidden">
        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=1920" class="w-full h-full object-cover" alt="Nature Panorama">
        <div class="absolute inset-0 bg-forest/20 backdrop-blur-[2px]"></div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-forest py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="flex items-center justify-center gap-2 text-sunlight mb-8">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
                <span class="font-heading font-bold text-2xl tracking-tight">TerraMarket</span>
            </div>
            <p class="text-sage opacity-50 text-sm">© 2026 TerraMarket Agricultural Marketplace. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            const progress = document.getElementById('loader-progress');
            
            // Fill the progress bar
            setTimeout(() => {
                progress.style.width = '100%';
            }, 100);

            // Fade out the preloader after progress is done
            setTimeout(() => {
                preloader.classList.add('fade-out');
            }, 2500);
        });
    </script>

</body>
</html>
