<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Terra - {{ $title ?? 'Auth' }}</title>

        <!-- Fonts -->
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
                font-family: 'DM Sans', sans-serif;
                overflow: hidden; /* No scroll needed for this layout */
            }
            .font-heading {
                font-family: 'Fraunces', serif;
                font-variation-settings: "SOFT" 100;
            }
            
            /* Form appearance refinement */
            input:focus, select:focus {
                outline: none !important;
                border-color: #1C3F2B !important;
                box-shadow: 0 0 0 4px rgba(28, 63, 43, 0.05) !important;
            }
        </style>
    </head>
    <body class="antialiased text-[#2D3A33]">
        
        <div class="min-h-screen flex flex-col md:flex-row overflow-hidden">
            
            <!-- Left Pane: The Scenery (Visual Impact) -->
            <div class="hidden md:block md:w-1/2 lg:w-3/5 relative overflow-hidden">
                <!-- Premium Terraced Farm Image -->
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80&w=1920" 
                     class="absolute inset-0 w-full h-full object-cover" 
                     alt="Lush Terraced Farm">
                <div class="absolute inset-0 bg-forest/20 backdrop-blur-[1px]"></div>
                
                <div class="absolute inset-0 p-12 flex flex-col justify-between">
                    <a href="/" class="group">
                        <div class="flex items-center gap-4">
                            <div class="relative w-14 h-14 flex items-center justify-center">
                                <div class="absolute inset-0 rounded-2xl bg-white/20 backdrop-blur-md border border-white/10 rotate-45 group-hover:rotate-90 transition-transform duration-700"></div>
                                <svg class="relative w-8 h-8 text-white group-hover:scale-110 transition-transform duration-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4V20M12 4L8 8M12 4L16 8" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="opacity-50"/>
                                    <path d="M7 14C7 14 8.5 12 12 12C15.5 12 17 14 17 14V17C17 18.6569 15.6569 20 14 20H10C8.34315 20 7 18.6569 7 17V14Z" fill="currentColor" class="text-sunlight/80"/>
                                    <path d="M12 12V8M12 8L10 10M12 8L14 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="flex flex-col -gap-1">
                                <span class="font-heading font-black text-3xl tracking-tighter text-white leading-none uppercase">Terra</span>
                                <span class="font-sans font-bold text-[11px] tracking-[0.4em] text-sunlight/60 leading-none uppercase ml-0.5">Market</span>
                            </div>
                        </div>
                    </a>
                    
                    <div class="max-w-lg">
                        <h2 class="text-white font-heading text-6xl leading-[1.1] mb-6 drop-shadow-2xl">Prosperity begins with a single <span class="italic text-sunlight">Seed.</span></h2>
                        <p class="text-sage/90 text-xl font-medium drop-shadow-lg">Empowering India's farmers with transparent pricing and premium quality inputs.</p>
                    </div>
                </div>
            </div>

            <!-- Right Pane: The Form (Direct & Accessible) -->
            <div class="w-full md:w-1/2 lg:w-2/5 bg-white flex flex-col justify-center px-8 md:px-12 lg:px-16 overflow-y-auto min-h-screen">
                <div class="py-12 w-full max-w-sm mx-auto">
                    <!-- Mobile Logo -->
                    <div class="md:hidden flex justify-center mb-8">
                        <a href="/" class="group">
                            <x-application-logo />
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
