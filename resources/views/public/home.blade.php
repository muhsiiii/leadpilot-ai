@extends('public.layout')

@section('title', 'LeadPilot AI - AI lead capture for business websites')
@section('description', 'LeadPilot AI gives businesses a hosted AI assistant, website widget, and dashboard to capture customer enquiries.')

@section('content')
    <section class="border-b border-slate-200 bg-slate-50">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 lg:grid-cols-[1fr_0.9fr] lg:items-center lg:px-8 lg:py-20">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">For business owners and service teams</p>
                <h1 class="mt-4 max-w-4xl text-4xl font-bold leading-tight sm:text-6xl">Add an AI lead assistant to your business in minutes.</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-700">
                    LeadPilot answers customer questions, collects contact details, and sends every enquiry into a dashboard your team can follow up from.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('register') }}" class="inline-flex justify-center rounded-md bg-emerald-700 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-800">
                        Create business account
                    </a>
                    <a href="{{ route('public.how-it-works') }}" class="inline-flex justify-center rounded-md border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-900 hover:border-emerald-700 hover:text-emerald-700">
                        See the customer flow
                    </a>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-xl">
                <div class="border-b border-slate-200 pb-4">
                    <p class="text-sm font-semibold uppercase tracking-wide text-slate-500">Product flow</p>
                    <p class="mt-2 text-xl font-bold text-slate-950">From visitor question to follow-up lead</p>
                </div>
                <div class="mt-5 space-y-3">
                    <div class="rounded-lg border border-slate-200 p-4">
                        <p class="text-sm font-semibold text-slate-950">1. Customer opens the assistant</p>
                        <p class="mt-1 text-sm text-slate-600">Through the business website widget, hosted page, ad link, social profile, or QR code.</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 p-4">
                        <p class="text-sm font-semibold text-slate-950">2. AI answers from approved business info</p>
                        <p class="mt-1 text-sm text-slate-600">Services, pricing notes, opening hours, location, FAQs, and owner instructions.</p>
                    </div>
                    <div class="rounded-lg border border-slate-200 p-4">
                        <p class="text-sm font-semibold text-slate-950">3. Lead is saved for the business</p>
                        <p class="mt-1 text-sm text-slate-600">Name, phone, email, requirement, date preference, and status are managed in the dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Who uses LeadPilot?</p>
            <h2 class="mt-3 text-3xl font-bold text-slate-950">Business clients use the app. Their customers use the assistant.</h2>
        </div>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-slate-950">Business owner</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Registers, creates a business profile, adds services and FAQs, installs the widget, and follows up with captured leads.</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-slate-950">Customer or website visitor</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">Normally does not create a LeadPilot account. They ask questions through the business assistant and leave contact details.</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-slate-950">LeadPilot dashboard</h3>
                <p class="mt-2 text-sm leading-6 text-slate-600">The business team tracks enquiries, changes lead status, and keeps the assistant knowledge updated.</p>
            </div>
        </div>
    </section>

    <section class="border-y border-slate-200 bg-slate-950 text-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-300">Built for existing websites</p>
                <h2 class="mt-3 text-3xl font-bold">LeadPilot does not replace your website. It helps your website convert.</h2>
                <p class="mt-4 text-sm leading-6 text-slate-300">A business can share a hosted assistant page immediately, then add a widget to the current website when ready.</p>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="font-semibold">Hosted assistant page</p>
                    <p class="mt-2 text-sm text-slate-300">Useful for ads, social profiles, QR codes, and businesses without a good website.</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="font-semibold">Website widget</p>
                    <p class="mt-2 text-sm text-slate-300">Useful for businesses that already have traffic on an existing website.</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="font-semibold">Owner dashboard</p>
                    <p class="mt-2 text-sm text-slate-300">Useful for tracking new, contacted, qualified, won, and lost leads.</p>
                </div>
                <div class="rounded-lg bg-white/10 p-4">
                    <p class="font-semibold">Knowledge controls</p>
                    <p class="mt-2 text-sm text-slate-300">Useful for keeping services, FAQs, and AI instructions accurate.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Simple plans</p>
                <h2 class="mt-3 text-3xl font-bold text-slate-950">Start with the plan that matches your conversation volume.</h2>
            </div>
            <a href="{{ route('public.pricing') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-900">View full pricing</a>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach ($plans as $key => $plan)
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-950">{{ $plan['name'] }}</h3>
                    <p class="mt-2 text-3xl font-bold">{{ $plan['price'] }}<span class="text-sm font-medium text-slate-500">/{{ $plan['period'] }}</span></p>
                    <p class="mt-3 text-sm leading-6 text-slate-600">{{ $plan['summary'] }}</p>
                    <p class="mt-4 text-sm font-semibold text-slate-900">{{ number_format($plan['conversation_limit']) }} AI conversations per month</p>
                </article>
            @endforeach
        </div>
    </section>

    <section class="bg-emerald-700">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-10 text-white sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
            <div>
                <h2 class="text-2xl font-bold">Ready to set up your first assistant?</h2>
                <p class="mt-2 text-sm text-emerald-50">Create an account, add your business details, and install the assistant where your customers already visit.</p>
            </div>
            <a href="{{ route('register') }}" class="inline-flex justify-center rounded-md bg-white px-5 py-3 text-sm font-semibold text-emerald-800 hover:bg-emerald-50">Start free setup</a>
        </div>
    </section>
@endsection
