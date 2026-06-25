<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Create your AI assistant</h2>
            <p class="mt-1 text-sm text-gray-600">Add the business details customers should see and the AI should answer from.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[0.75fr_1.25fr] lg:px-8">
            <aside class="rounded-lg border border-emerald-200 bg-emerald-50 p-5 text-emerald-950">
                <h3 class="font-semibold">Onboarding path</h3>
                <div class="mt-4 space-y-4 text-sm leading-6">
                    <p><span class="font-semibold">1. Business profile:</span> Add the details customers should see.</p>
                    <p><span class="font-semibold">2. Services:</span> Add what customers can ask about.</p>
                    <p><span class="font-semibold">3. FAQs:</span> Add answers your team repeats often.</p>
                    <p><span class="font-semibold">4. Install:</span> Share the hosted page or add the widget to your website.</p>
                </div>
            </aside>

            <form method="POST" action="{{ route('businesses.store') }}" class="space-y-5 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                @csrf

                @include('businesses.partials.form', ['business' => null])

                <button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Save and add services</button>
            </form>
        </div>
    </div>
</x-app-layout>
