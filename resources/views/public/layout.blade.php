<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'LeadPilot AI')</title>
    <meta name="description" content="@yield('description', 'LeadPilot AI helps businesses capture qualified leads through an AI website assistant and owner dashboard.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-950">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-lg font-bold">
                <span class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-950 text-sm font-black text-white">LP</span>
                <span>LeadPilot AI</span>
            </a>

            <nav class="hidden items-center gap-6 text-sm font-medium text-slate-700 md:flex">
                <a href="{{ route('public.how-it-works') }}" class="hover:text-emerald-700">How it works</a>
                <a href="{{ route('public.pricing') }}" class="hover:text-emerald-700">Pricing</a>
                <a href="{{ route('public.docs') }}" class="hover:text-emerald-700">Setup guide</a>
            </nav>

            <div class="flex items-center gap-2 text-sm font-semibold">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-md bg-slate-950 px-4 py-2 text-white hover:bg-emerald-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hidden rounded-md px-3 py-2 text-slate-700 hover:text-emerald-700 sm:inline-flex">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-emerald-700 px-4 py-2 text-white hover:bg-emerald-800">Start free setup</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 bg-slate-950 text-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 sm:px-6 md:grid-cols-[1.2fr_0.8fr_0.8fr] lg:px-8">
            <div>
                <p class="text-lg font-bold">LeadPilot AI</p>
                <p class="mt-3 max-w-md text-sm leading-6 text-slate-300">AI lead capture for businesses that want more enquiries from their website, campaigns, and social traffic.</p>
            </div>
            <div>
                <p class="font-semibold">Product</p>
                <div class="mt-3 space-y-2 text-sm text-slate-300">
                    <a href="{{ route('public.how-it-works') }}" class="block hover:text-white">How it works</a>
                    <a href="{{ route('public.pricing') }}" class="block hover:text-white">Pricing</a>
                    <a href="{{ route('public.docs') }}" class="block hover:text-white">Setup guide</a>
                </div>
            </div>
            <div>
                <p class="font-semibold">Account</p>
                <div class="mt-3 space-y-2 text-sm text-slate-300">
                    <a href="{{ route('register') }}" class="block hover:text-white">Create account</a>
                    <a href="{{ route('login') }}" class="block hover:text-white">Login</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
