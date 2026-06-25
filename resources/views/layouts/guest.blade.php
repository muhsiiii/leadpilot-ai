<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LeadPilot AI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="flex min-h-screen flex-col items-center bg-slate-100 px-4 pt-6 sm:justify-center sm:pt-0">
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-xl font-bold text-slate-950">
                    <span class="flex h-10 w-10 items-center justify-center rounded-md bg-slate-950 text-sm font-black text-white">LP</span>
                    <span>LeadPilot AI</span>
                </a>
                <p class="mt-3 max-w-sm text-sm text-slate-600">Create and manage an AI lead assistant for your business.</p>
            </div>

            <div class="mt-6 w-full overflow-hidden rounded-lg bg-white px-6 py-5 shadow-md sm:max-w-md">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
