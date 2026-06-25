<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    LeadPilot Dashboard
                </h2>
                <p class="mt-1 text-sm text-gray-600">Track the leads your AI assistant captures.</p>
            </div>

            <a href="{{ route('business.chat', $business) }}" target="_blank" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                Open Client Chat
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">
                <section class="grid gap-4 md:grid-cols-4">
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Total Leads</p>
                        <p class="mt-2 text-3xl font-bold text-gray-950">{{ $business->leads_count }}</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">New Leads</p>
                        <p class="mt-2 text-3xl font-bold text-emerald-700">{{ $business->new_leads_count }}</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">Today</p>
                        <p class="mt-2 text-3xl font-bold text-gray-950">{{ $business->today_leads_count }}</p>
                    </div>
                    <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <p class="text-sm font-medium text-gray-500">AI Messages</p>
                        <p class="mt-2 text-3xl font-bold text-gray-950">{{ $business->ai_messages_count }}</p>
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-950">{{ $business->name }}</h3>
                            <p class="mt-1 text-sm text-gray-600">{{ $business->description }}</p>
                            <p class="mt-2 text-xs font-semibold uppercase text-gray-500">{{ $business->plan }} plan · {{ number_format($business->monthly_conversation_limit) }} conversations/month</p>
                        </div>
                        <div class="rounded-md bg-gray-100 px-3 py-2 text-sm text-gray-700">
                            Embed URL: <span class="font-mono">{{ route('business.chat', $business) }}</span>
                        </div>
                    </div>
                </section>

                <section class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200 p-5">
                        <h3 class="text-lg font-semibold text-gray-950">Latest Captured Leads</h3>
                        <p class="mt-1 text-sm text-gray-600">Call these quickly. Speed is the product.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <tr>
                                    <th class="px-5 py-3">Lead</th>
                                    <th class="px-5 py-3">Requirement</th>
                                    <th class="px-5 py-3">Preferred Date</th>
                                    <th class="px-5 py-3">Status</th>
                                    <th class="px-5 py-3">Captured</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($leads as $lead)
                                    <tr>
                                        <td class="px-5 py-4 align-top">
                                            <p class="font-semibold text-gray-950">{{ $lead->name ?? 'Name missing' }}</p>
                                            <p class="mt-1 text-gray-700">{{ $lead->phone ?? 'No phone' }}</p>
                                            @if ($lead->email)
                                                <p class="mt-1 text-gray-500">{{ $lead->email }}</p>
                                            @endif
                                        </td>
                                        <td class="max-w-md px-5 py-4 align-top text-gray-700">{{ $lead->requirement }}</td>
                                        <td class="px-5 py-4 align-top text-gray-700">{{ $lead->preferred_date ?? '-' }}</td>
                                        <td class="px-5 py-4 align-top">
                                            <form method="POST" action="{{ route('businesses.leads.status', [$business, $lead]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="rounded-md border-gray-300 text-xs font-semibold uppercase focus:border-emerald-600 focus:ring-emerald-600">
                                                    @foreach (['new', 'contacted', 'qualified', 'won', 'lost'] as $status)
                                                        <option value="{{ $status }}" @selected($lead->status === $status)>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-5 py-4 align-top text-gray-500">{{ $lead->created_at->diffForHumans() }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-5 py-8 text-center text-gray-500">
                                            No leads yet. Open the client chat and submit a test message with a phone number.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
        </div>
    </div>
</x-app-layout>
