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
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50 dark:bg-slate-950 text-slate-850 dark:text-slate-100 min-h-screen relative overflow-hidden flex flex-col justify-center items-center">
        <!-- Floating Glass/Mesh Glow Blobs -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-500/10 dark:bg-indigo-500/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute top-1/3 left-1/4 w-80 h-80 bg-purple-500/10 dark:bg-purple-500/5 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-pink-500/10 dark:bg-pink-500/5 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-8 glass-panel rounded-2xl relative z-10">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-application-logo class="w-16 h-16 fill-current text-indigo-600 dark:text-indigo-400" />
                </a>
            </div>

            {{ $slot }}
        </div>
    </body>
</html>
