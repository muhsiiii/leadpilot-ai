<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LeadPilot AI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-950">
    <header class="border-b border-slate-200">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="/" class="text-lg font-bold">LeadPilot AI</a>
            <nav class="flex items-center gap-3 text-sm font-medium">
                <a href="{{ route('chat.index') }}" class="text-slate-700 hover:text-emerald-700">Demo Chat</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-md bg-slate-950 px-4 py-2 text-white hover:bg-emerald-700">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-md bg-slate-950 px-4 py-2 text-white hover:bg-emerald-700">Login</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        <section class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-[1fr_0.9fr] lg:items-center lg:px-8 lg:py-20">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">AI lead capture for local businesses</p>
                <h1 class="mt-4 max-w-4xl text-5xl font-bold leading-tight sm:text-6xl">Turn missed website visitors into callback-ready leads.</h1>
                <p class="mt-6 max-w-2xl text-lg text-slate-700">
                    LeadPilot answers service questions, asks for contact details, stores leads, and gives owners a simple dashboard they can act on fast.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('chat.index') }}" class="inline-flex justify-center rounded-md bg-emerald-700 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-800">
                        Try Demo Chat
                    </a>
                    <a href="{{ route('dashboard') }}" class="inline-flex justify-center rounded-md border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-900 hover:border-emerald-700 hover:text-emerald-700">
                        View Dashboard
                    </a>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-slate-50 p-5 shadow-xl">
                <div class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm font-semibold text-slate-500">New lead captured</p>
                    <p class="mt-3 text-lg font-bold">Dental cleaning tomorrow</p>
                    <div class="mt-4 space-y-2 text-sm text-slate-700">
                        <p><span class="font-semibold text-slate-950">Name:</span> Vijay</p>
                        <p><span class="font-semibold text-slate-950">Phone:</span> 9876543210</p>
                        <p><span class="font-semibold text-slate-950">Status:</span> New</p>
                    </div>
                </div>
                <div class="mt-4 grid gap-3 sm:grid-cols-3">
                    <div class="rounded-lg bg-white p-4 shadow-sm">
                        <p class="text-sm text-slate-500">Chats</p>
                        <p class="mt-1 text-2xl font-bold">128</p>
                    </div>
                    <div class="rounded-lg bg-white p-4 shadow-sm">
                        <p class="text-sm text-slate-500">Leads</p>
                        <p class="mt-1 text-2xl font-bold">37</p>
                    </div>
                    <div class="rounded-lg bg-white p-4 shadow-sm">
                        <p class="text-sm text-slate-500">Speed</p>
                        <p class="mt-1 text-2xl font-bold">24/7</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="border-y border-slate-200 bg-slate-50">
            <div class="mx-auto grid max-w-7xl gap-4 px-4 py-10 sm:px-6 md:grid-cols-3 lg:px-8">
                <div>
                    <p class="font-semibold">Best first niche</p>
                    <p class="mt-2 text-sm text-slate-700">Dental clinics, small clinics, salons, home service companies, coaching centers.</p>
                </div>
                <div>
                    <p class="font-semibold">Simple offer</p>
                    <p class="mt-2 text-sm text-slate-700">Setup fee plus monthly support. Sell captured leads, not AI buzzwords.</p>
                </div>
                <div>
                    <p class="font-semibold">Fast path to money</p>
                    <p class="mt-2 text-sm text-slate-700">Install for 5 businesses manually, prove leads, then automate onboarding.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
