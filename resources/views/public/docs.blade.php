@extends('public.layout')

@section('title', 'LeadPilot AI setup guide')

@section('content')
    <section class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Setup guide</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-bold text-slate-950">Use LeadPilot correctly from day one.</h1>
            <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-700">The assistant is strongest when the business information is specific, accurate, and easy for customers to act on.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-5 lg:grid-cols-[0.8fr_1.2fr]">
            <aside class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="font-semibold text-slate-950">Recommended launch checklist</h2>
                <div class="mt-4 space-y-3 text-sm leading-6 text-slate-700">
                    <p>Complete the business profile.</p>
                    <p>Add the services customers ask about most.</p>
                    <p>Add FAQs for price, timing, location, booking, and contact rules.</p>
                    <p>Test the hosted assistant page.</p>
                    <p>Install the website widget or share the hosted page.</p>
                    <p>Check the dashboard daily and contact new leads quickly.</p>
                </div>
            </aside>
            <div class="space-y-5">
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-slate-950">1. Business profile</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-700">Use the profile page to enter the public details customers need: business type, phone, email, website, address, opening hours, description, and extra AI instructions.</p>
                </article>
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-slate-950">2. Services and FAQs</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-700">Add services with clear names, descriptions, and starting prices where appropriate. Add FAQs that answer common pre-sale questions.</p>
                </article>
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-slate-950">3. Installation</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-700">Use the hosted page for quick launch. Use the widget script when the business already has a website. The widget lets customers ask questions without leaving that site.</p>
                </article>
                <article class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
                    <h2 class="font-semibold text-slate-950">4. Follow-up process</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-700">LeadPilot captures enquiries. The business still owns the sale. Move each lead through the dashboard status pipeline and contact qualified customers promptly.</p>
                </article>
            </div>
        </div>
    </section>
@endsection
