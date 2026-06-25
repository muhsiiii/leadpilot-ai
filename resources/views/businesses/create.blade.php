<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create your AI assistant</h2>
            <p class="mt-1 text-sm text-gray-600">Add the business details customers should see and the AI should answer from.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('businesses.store') }}" class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                @csrf

                @include('businesses.partials.form', ['business' => null])

                <button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Create assistant</button>
            </form>
        </div>
    </div>
</x-app-layout>
