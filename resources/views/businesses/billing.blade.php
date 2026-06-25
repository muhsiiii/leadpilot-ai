<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Billing</h2>
            <p class="mt-1 text-sm text-gray-600">MVP plan controls. Payment gateway integration comes next.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-4 md:grid-cols-3">
                @foreach ($plans as $key => $plan)
                    <form method="POST" action="{{ route('businesses.billing.update', $business) }}" class="rounded-lg border {{ $business->plan === $key ? 'border-emerald-500 ring-2 ring-emerald-100' : 'border-gray-200' }} bg-white p-5 shadow-sm">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="plan" value="{{ $key }}">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-950">{{ $plan['name'] }}</h3>
                                <p class="mt-1 text-2xl font-bold text-gray-950">{{ $plan['price'] }}<span class="text-sm font-medium text-gray-500">/{{ $plan['period'] }}</span></p>
                            </div>
                            @if ($business->plan === $key)
                                <span class="rounded-md bg-emerald-50 px-2 py-1 text-xs font-semibold uppercase text-emerald-700">Current</span>
                            @endif
                        </div>
                        <p class="mt-4 text-sm text-gray-600">{{ $plan['summary'] }}</p>
                        <p class="mt-2 text-sm font-semibold text-gray-800">{{ number_format($plan['conversation_limit']) }} AI conversations per month.</p>
                        <ul class="mt-4 space-y-2 text-sm text-gray-600">
                            @foreach ($plan['features'] as $feature)
                                <li class="flex gap-2"><span class="font-semibold text-emerald-700">Included</span><span>{{ $feature }}</span></li>
                            @endforeach
                        </ul>
                        <button class="mt-5 w-full rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Choose {{ $plan['name'] }}</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
