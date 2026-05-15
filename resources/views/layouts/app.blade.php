<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@SOFT@9..144,300..900,50..100&display=swap" rel="stylesheet">

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
                            gold: '#D4AF37',
                            cream: '#F5F5DC',
                            emerald: '#065f46',
                        },
                        fontFamily: {
                            heading: ['Fraunces', 'serif'],
                            sans: ['DM Sans', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            :root {
                --forest-green: #1C3F2B;
                --sage-green: #E4EBE5;
                --earth-brown: #8C6A53;
                --sunlight: #FDF9EC;
            }

            body {
                background-color: #FDF9EC;
            }

            .font-heading {
                font-family: 'Fraunces', serif;
            }

            /* Custom Premium Shadows */
            .premium-shadow {
                box-shadow: 0 25px 50px -12px rgba(28, 63, 43, 0.08);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="pt-12 pb-10">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <h2 class="font-heading font-bold text-5xl text-[var(--forest-green)] leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-6 lg:px-8 pb-32">
                @if(session('success'))
                    <div class="mb-12 bg-forest text-gold px-10 py-6 rounded-[2rem] shadow-2xl flex items-center justify-between animate-fade-in border border-gold/20">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-gold/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-[10px] font-black uppercase tracking-[0.3em]">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-gold/40 hover:text-gold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
                {{ $slot }}
            </main>

            <x-noble-taskbar />
        </div>
    </body>
</html>
