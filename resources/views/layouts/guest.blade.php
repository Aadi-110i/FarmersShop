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
                    <a href="/" class="flex items-center gap-3 text-white group">
                        <div class="bg-white/20 backdrop-blur-md p-2 rounded-xl group-hover:bg-white/30 transition-all">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
                        </div>
                        <span class="font-heading font-bold text-4xl tracking-tight drop-shadow-lg">TerraMarket</span>
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
                        <a href="/" class="flex items-center gap-2 text-forest">
                            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm-1-15h2v6h-2V7zm0 8h2v2h-2v-2z" opacity="0.3"/><path d="M11 21.9v-2.1c-4.4-.5-8-4.1-8.5-8.5H.4c.5 5.5 4.9 9.9 10.6 10.6zm2 0c5.7-.7 10.1-5.1 10.6-10.6h-2.1c-.5 4.4-4.1 8-8.5 8.5v2.1zM2.5 11h2.1c.5-4.4 4.1-8 8.5-8.5V.4C7.4 1.1 3 5.5 2.5 11zm19 0c-.5-5.5-4.9-9.9-10.6-10.6v2.1c4.4.5 8 4.1 8.5 8.5h2.1z"/></svg>
                            <span class="font-heading font-bold text-2xl tracking-tight">Terra</span>
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>

        </div>
    </body>
</html>
