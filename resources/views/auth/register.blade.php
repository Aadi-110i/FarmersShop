<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Terra Market - Editorial Registration</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght,SOFT@9..144,300..900,50..100&display=swap" rel="stylesheet">

    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                    },
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #FDF9EC; /* Sunlight/Cream */
            color: #1C3F2B; /* Forest */
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
        }

        .font-heading {
            font-family: 'Fraunces', serif;
            font-variation-settings: "SOFT" 100, "opsz" 72;
        }

        /* Stark Editorial Borders */
        .editorial-input {
            background: transparent;
            border: none;
            border-bottom: 2px solid #1C3F2B;
            border-radius: 0;
            padding-left: 0;
            padding-right: 0;
            transition: all 0.3s ease;
        }

        .editorial-input:focus {
            outline: none;
            border-bottom-width: 4px;
            padding-bottom: 0.5rem;
        }

        .editorial-btn {
            background-color: #1C3F2B;
            color: #FDF9EC;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
        }

        .editorial-btn:hover {
            background-color: #8C6A53;
            transform: translateY(-2px);
        }

        @keyframes reveal-up {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .animate-reveal {
            animation: reveal-up 1.2s cubic-bezier(0.19, 1, 0.22, 1) forwards;
        }

        .delay-1 { animation-delay: 0.2s; opacity: 0; }
        .delay-2 { animation-delay: 0.4s; opacity: 0; }
        .delay-3 { animation-delay: 0.6s; opacity: 0; }

        /* Grain texture for editorial feel */
        .grain {
            position: fixed;
            inset: 0;
            z-index: 50;
            pointer-events: none;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        /* Custom Radio Styling */
        .role-card {
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .role-input:checked + .role-card {
            border-bottom-width: 6px;
            background-color: rgba(28, 63, 43, 0.03);
            transform: translateY(-4px);
        }
    </style>
</head>
<body class="antialiased min-h-screen">
    <div class="grain"></div>
    
    <div class="flex flex-col lg:flex-row min-h-screen">
        
        <!-- Left Pane: The Atmospheric Visual (Same as Login) -->
        <div class="lg:w-7/12 relative min-h-[50vh] lg:min-h-screen overflow-hidden group bg-forest">
            <!-- Full Bleed Video Background -->
            <video autoplay loop muted playsinline 
                   class="absolute inset-0 w-full h-full object-cover opacity-80 transition-opacity duration-1000">
                <source src="/videos/clouds.mp4" type="video/mp4">
            </video>
            
            <!-- Soft Atmospheric Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-forest/60 via-transparent to-forest/20"></div>

            <!-- Ethereal UI Layer -->
            <div class="absolute inset-0 p-12 lg:p-24 flex flex-col justify-center items-center text-center text-sunlight pointer-events-none">
                
                <div class="animate-reveal">
                    <span class="inline-block text-[10px] font-bold uppercase tracking-[0.8em] text-sunlight/40 mb-8">Terra Market Presents</span>
                    
                    <h2 class="text-6xl lg:text-[8rem] font-heading italic font-light leading-none tracking-tight mb-10 drop-shadow-xl">
                        Future, <br>
                        <span class="opacity-80">Rooted.</span>
                    </h2>
                    
                    <div class="w-24 h-px bg-sunlight/30 mx-auto mb-10"></div>
                    
                    <p class="text-sm lg:text-lg font-medium tracking-widest opacity-60 max-w-lg mx-auto leading-relaxed italic">
                        "Join the collective of stewards <br> and kisan."
                    </p>
                </div>

                <!-- Subtle Brand Signature -->
                <div class="absolute bottom-12 left-1/2 -translate-x-1/2 animate-reveal delay-2">
                    <div class="flex items-center gap-4">
                        <div class="w-8 h-px bg-sunlight/20"></div>
                        <span class="text-[9px] font-bold uppercase tracking-[0.4em] opacity-30 whitespace-nowrap">Est. MMXXVI // Member Access</span>
                        <div class="w-8 h-px bg-sunlight/20"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Pane: The Editorial Registration Form -->
        <div class="lg:w-5/12 flex items-center justify-center p-8 lg:p-20 bg-sunlight relative">
            <div class="w-full max-w-sm">
                
                <header class="mb-12 animate-reveal delay-1">
                    <div class="flex items-center gap-6 mb-8">
                        <div class="w-16 h-0.5 bg-earth"></div>
                        <span class="text-[11px] font-bold uppercase tracking-[0.5em] text-earth">Portal 02 // Register</span>
                    </div>
                    <h1 class="text-7xl font-heading mb-6 leading-[0.9] tracking-tight text-forest">Begin <br>Journey.</h1>
                    <p class="text-xs font-medium text-forest/60 leading-relaxed max-w-[280px]">Create your credentials to enter the most transparent agricultural network.</p>
                </header>

                <form method="POST" action="{{ route('register') }}" class="space-y-10 animate-reveal delay-2">
                    @csrf

                    <!-- Name Field -->
                    <div class="group">
                        <label for="name" class="block text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-2 ml-1 group-focus-within:text-earth transition-colors">Steward // Name</label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               placeholder="Full Name"
                               class="editorial-input w-full text-lg font-medium text-forest placeholder-forest/10 focus:placeholder-transparent" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-[9px] font-bold uppercase text-earth tracking-widest" />
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                        <label for="email" class="block text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-2 ml-1 group-focus-within:text-earth transition-colors">Credential // Email</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               placeholder="steward@terra.market"
                               class="editorial-input w-full text-lg font-medium text-forest placeholder-forest/10 focus:placeholder-transparent" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[9px] font-bold uppercase text-earth tracking-widest" />
                    </div>

                    <!-- Role Selection (Editorial Cards) -->
                    <div class="space-y-4">
                        <label class="block text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 ml-1">Vocation // Intent</label>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Farmer -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="farmer" class="role-input sr-only" {{ old('role', 'farmer') === 'farmer' ? 'checked' : '' }}>
                                <div class="role-card p-6 border-b-2 border-forest/10 flex flex-col items-center text-center">
                                    <span class="text-2xl mb-2">🌱</span>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-forest">Farmer</span>
                                </div>
                            </label>

                            <!-- Supplier -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="supplier" class="role-input sr-only" {{ old('role') === 'supplier' ? 'checked' : '' }}>
                                <div class="role-card p-6 border-b-2 border-forest/10 flex flex-col items-center text-center">
                                    <span class="text-2xl mb-2">🚜</span>
                                    <span class="text-[9px] font-black uppercase tracking-widest text-forest">Supplier</span>
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2 text-[9px] font-bold uppercase text-earth tracking-widest" />
                    </div>

                    <!-- Password Fields -->
                    <div class="grid grid-cols-2 gap-8">
                        <div class="group">
                            <label for="password" class="block text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-2 ml-1 group-focus-within:text-earth transition-colors">Access // Key</label>
                            <input id="password" 
                                   type="password" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password" 
                                   placeholder="••••••••"
                                   class="editorial-input w-full text-lg font-medium text-forest placeholder-forest/10 focus:placeholder-transparent" />
                        </div>
                        <div class="group">
                            <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-[0.3em] text-forest/40 mb-2 ml-1 group-focus-within:text-earth transition-colors">Confirm // Key</label>
                            <input id="password_confirmation" 
                                   type="password" 
                                   name="password_confirmation" 
                                   required 
                                   placeholder="••••••••"
                                   class="editorial-input w-full text-lg font-medium text-forest placeholder-forest/10 focus:placeholder-transparent" />
                        </div>
                        <div class="col-span-2">
                            <x-input-error :messages="$errors->get('password')" class="text-[9px] font-bold uppercase text-earth tracking-widest" />
                        </div>
                    </div>

                    <!-- Action Area -->
                    <div class="pt-6">
                        <button type="submit" class="editorial-btn w-full py-6 font-black uppercase tracking-[0.5em] text-[10px] shadow-[12px_12px_0px_rgba(28,63,43,0.05)] hover:shadow-none">
                            Create Account
                        </button>
                    </div>
                </form>

                <footer class="mt-16 pt-10 border-t border-forest/5 animate-reveal delay-3">
                    <div class="flex justify-between items-center">
                        <p class="text-[9px] font-bold text-forest/20 uppercase tracking-[0.2em]">©2026 Terra Market</p>
                        <a href="{{ route('login') }}" class="text-[10px] font-bold text-earth uppercase tracking-[0.4em] hover:text-forest transition-all flex items-center gap-3 group">
                            Sign In
                            <div class="w-6 h-px bg-earth group-hover:w-10 transition-all"></div>
                        </a>
                    </div>
                </footer>
            </div>
        </div>

    </div>

</body>
</html>
