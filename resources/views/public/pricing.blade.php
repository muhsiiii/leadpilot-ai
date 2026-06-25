@extends('public.layout')

@section('title', 'LeadPilot AI pricing')

@section('content')
    <section class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <p class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Pricing</p>
            <h1 class="mt-4 max-w-3xl text-4xl font-bold text-slate-950">Plans for businesses that want more qualified enquiries.</h1>
            <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-700">Choose by expected monthly AI conversations. Payment processing is prepared as the next production step.</p>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ($plans as $key => $plan)
                <article class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-slate-950">{{ $plan['name'] }}</h2>
                    <p class="mt-3 text-4xl font-bold">{{ $plan['price'] }}<span class="text-sm font-medium text-slate-500">/{{ $plan['period'] }}</span></p>
                    <p class="mt-4 text-sm leading-6 text-slate-600">{{ $plan['summary'] }}</p>
                    <p class="mt-4 text-sm font-semibold text-slate-900">{{ number_format($plan['conversation_limit']) }} AI conversations per month</p>
                    <ul class="mt-5 space-y-3 text-sm text-slate-700">
                        @foreach ($plan['features'] as $feature)
                            <li class="flex gap-2"><span class="font-semibold text-emerald-700">Included</span><span>{{ $feature }}</span></li>
                        @endforeach
                    </ul>
                    <a href="{{ route('register') }}" class="mt-6 inline-flex w-full justify-center rounded-md bg-slate-950 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Start setup</a>
                </article>
            @endforeach
        </div>
    </section>
@endsection
