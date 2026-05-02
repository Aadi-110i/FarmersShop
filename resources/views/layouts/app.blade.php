<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Terra - {{ $header ?? 'Marketplace' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght,SOFT@9..144,300..900,50..100&display=swap" rel="stylesheet">

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
                background-color: var(--sunlight);
                font-family: 'DM Sans', sans-serif;
                background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.04'/%3E%3C/svg%3E");
            }
            .font-heading {
                font-family: 'Fraunces', serif;
                font-variation-settings: "SOFT" 100;
            }
        </style>
    </head>
    <body class="antialiased text-[#2D3A33]">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/50 backdrop-blur-md border-b border-[var(--sage-green)]">
                    <div class="max-w-7xl mx-auto py-10 px-6">
                        <h2 class="font-heading text-4xl text-[var(--forest-green)] leading-tight">
                            {{ $header }}
                        </h2>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow py-12 px-6">
                <div class="max-w-7xl mx-auto">
                    {{ $slot }}
                </div>
            </main>

            <!-- Nature Decor -->
            <div class="pointer-events-none fixed bottom-0 right-0 opacity-10">
                <svg class="w-96 h-96 translate-x-1/4 translate-y-1/4" fill="var(--forest-green)" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <path d="M45.7,-76.4C58.9,-69.3,68.9,-54.6,76.5,-40.1C84.1,-25.6,89.3,-11.3,87.6,2.2C85.8,15.7,77,28.4,67.6,39.6C58.2,50.8,48.2,60.5,36.1,68.6C24,76.7,9.8,83.2,-4.2,88.9C-18.2,94.6,-32.4,99.5,-44.7,93.9C-57,88.3,-67.4,72.2,-74.6,56.1C-81.8,40,-85.8,24,-86.6,8.2C-87.4,-7.6,-85.1,-23.2,-77.8,-36.5C-70.5,-49.8,-58.3,-60.8,-44.6,-67.5C-30.9,-74.2,-15.5,-76.6,0.6,-77.5C16.7,-78.4,32.5,-83.5,45.7,-76.4Z" transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </body>
</html>
