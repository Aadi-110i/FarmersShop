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
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
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
                <header class="pt-28 pb-10">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <h2 class="font-heading font-bold text-5xl text-[var(--forest-green)] leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-6 lg:px-8 pb-12">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
