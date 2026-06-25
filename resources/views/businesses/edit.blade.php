<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Business profile</h2>
            <p class="mt-1 text-sm text-gray-600">This information powers your hosted page, website widget, and AI replies.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-md bg-emerald-50 p-3 text-sm font-medium text-emerald-800">Saved.</div>
            @endif

            <form method="POST" action="{{ route('businesses.update', $business) }}" class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                @csrf
                @method('PATCH')

                @include('businesses.partials.form', ['business' => $business])

                <button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Save profile</button>
            </form>
        </div>
    </div>
</x-app-layout>
