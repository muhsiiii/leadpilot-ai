<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Prospect Lab
            </h2>
            <p class="text-sm text-gray-600">Research targets, pain signals, offer angle, and outreach status.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="grid gap-4 md:grid-cols-4">
                <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Prospects</p>
                    <p class="mt-2 text-3xl font-bold text-gray-950">{{ $prospects->count() }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Research</p>
                    <p class="mt-2 text-3xl font-bold text-gray-950">{{ $statusCounts['research'] ?? 0 }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Contacted</p>
                    <p class="mt-2 text-3xl font-bold text-gray-950">{{ $statusCounts['contacted'] ?? 0 }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Interested/Won</p>
                    <p class="mt-2 text-3xl font-bold text-emerald-700">{{ ($statusCounts['interested'] ?? 0) + ($statusCounts['won'] ?? 0) }}</p>
                </div>
            </section>

            <section class="rounded-lg border border-emerald-200 bg-emerald-50 p-5 text-emerald-950">
                <h3 class="font-semibold">Best first outreach angle</h3>
                <p class="mt-2 text-sm">
                    Start with businesses that have clear enquiry value but weak automation. Offer a low-risk pilot:
                    "I built an AI enquiry assistant for service businesses. It answers common questions and captures name plus phone for callback. Can I show you a short walkthrough using your services?"
                </p>
            </section>

            <section class="space-y-4">
                @foreach ($prospects as $prospect)
                    <article class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div class="max-w-3xl">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-lg font-semibold text-gray-950">{{ $prospect->business_name }}</h3>
                                    <span class="rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold uppercase text-gray-700">{{ $prospect->category }}</span>
                                    <span class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold uppercase text-emerald-700">Score {{ $prospect->priority_score }}</span>
                                    <span class="rounded-md bg-amber-50 px-2 py-1 text-xs font-semibold uppercase text-amber-700">{{ $prospect->budget_fit }}</span>
                                </div>

                                <p class="mt-2 text-sm text-gray-600">{{ $prospect->area }} @if ($prospect->phone) | {{ $prospect->phone }} @endif</p>

                                @if ($prospect->website)
                                    <a href="{{ $prospect->website }}" target="_blank" class="mt-2 inline-block text-sm font-medium text-emerald-700 hover:text-emerald-900">{{ $prospect->website }}</a>
                                @endif

                                <div class="mt-4 grid gap-4 lg:grid-cols-3">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Public Signal</p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $prospect->public_signal }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Likely Need</p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $prospect->pain_hypothesis }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Offer</p>
                                        <p class="mt-1 text-sm text-gray-800">{{ $prospect->proposed_solution }}</p>
                                    </div>
                                </div>

                                @if ($prospect->notes)
                                    <p class="mt-4 rounded-md bg-gray-50 p-3 text-sm text-gray-700">{{ $prospect->notes }}</p>
                                @endif
                            </div>

                            <form method="POST" action="{{ route('prospects.status', $prospect) }}" class="flex min-w-48 flex-col gap-2">
                                @csrf
                                @method('PATCH')
                                <label class="text-xs font-semibold uppercase tracking-wide text-gray-500" for="status-{{ $prospect->id }}">Status</label>
                                <select id="status-{{ $prospect->id }}" name="status" class="rounded-md border-gray-300 text-sm focus:border-emerald-600 focus:ring-emerald-600">
                                    @foreach (['research', 'contacted', 'interested', 'not_now', 'won', 'lost'] as $status)
                                        <option value="{{ $status }}" @selected($prospect->status === $status)>{{ str_replace('_', ' ', ucfirst($status)) }}</option>
                                    @endforeach
                                </select>
                                <button class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Update</button>
                                @if ($prospect->last_contacted_at)
                                    <p class="text-xs text-gray-500">Last contacted {{ $prospect->last_contacted_at->diffForHumans() }}</p>
                                @endif
                            </form>
                        </div>
                    </article>
                @endforeach
            </section>
        </div>
    </div>
</x-app-layout>
