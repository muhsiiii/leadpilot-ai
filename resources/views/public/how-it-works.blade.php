@extends('public.layout')

@section('title', 'How LeadPilot AI works')

@section('content')
    <section class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">How it works</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-bold text-slate-950">LeadPilot connects your business knowledge to a customer-facing assistant.</h1>
            <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-700">Business clients manage the assistant in LeadPilot. Customers use it from the business website, hosted page, social profile link, QR code, or campaign link.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-5 md:grid-cols-2">
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-950">For business clients</h2>
                <ol class="mt-5 space-y-4 text-sm leading-6 text-slate-700">
                    <li><span class="font-semibold text-slate-950">1. Create account.</span> Register and create the business profile.</li>
                    <li><span class="font-semibold text-slate-950">2. Add knowledge.</span> Enter services, price notes, FAQs, hours, location, and instructions.</li>
                    <li><span class="font-semibold text-slate-950">3. Install or share.</span> Use the hosted page immediately or paste the widget script into the website.</li>
                    <li><span class="font-semibold text-slate-950">4. Follow up.</span> Check the dashboard and move leads through new, contacted, qualified, won, or lost.</li>
                </ol>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-950">For customers</h2>
                <ol class="mt-5 space-y-4 text-sm leading-6 text-slate-700">
                    <li><span class="font-semibold text-slate-950">1. Ask a question.</span> Customers ask about services, pricing, availability, or next steps.</li>
                    <li><span class="font-semibold text-slate-950">2. Get a short answer.</span> The assistant replies using the business-approved information.</li>
                    <li><span class="font-semibold text-slate-950">3. Share contact details.</span> When interested, customers can leave name, phone, email, requirement, and preferred date.</li>
                    <li><span class="font-semibold text-slate-950">4. Wait for follow-up.</span> The assistant does not confirm appointments; the business team contacts the customer.</li>
                </ol>
            </div>
        </div>
    </section>
@endsection
