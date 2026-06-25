<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Install assistant</h2>
            <p class="mt-1 text-sm text-gray-600">Share your hosted page or paste the widget script into an existing website.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-gray-950">Hosted AI page</h3>
                <p class="mt-2 text-sm text-gray-600">Use this link in ads, Instagram bio, Google Business profile, WhatsApp auto-replies, or QR codes.</p>
                <div class="mt-4 rounded-md bg-gray-100 p-3 font-mono text-sm text-gray-800">{{ route('business.chat', $business) }}</div>
                <a href="{{ route('business.chat', $business) }}" target="_blank" class="mt-4 inline-flex rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Open page</a>
            </section>

            <section class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                <h3 class="font-semibold text-gray-950">Website widget</h3>
                <p class="mt-2 text-sm text-gray-600">Paste this before the closing body tag on the client website. It adds a small floating button that opens the assistant.</p>
                <pre class="mt-4 overflow-x-auto rounded-md bg-gray-950 p-4 text-sm text-white"><code>&lt;script async src="{{ route('widget.script') }}" data-business="{{ $business->slug }}"&gt;&lt;/script&gt;</code></pre>
            </section>

            <section class="rounded-lg border border-emerald-200 bg-emerald-50 p-5 text-emerald-950">
                <h3 class="font-semibold">Best launch flow</h3>
                <p class="mt-2 text-sm">Add the hosted page to social profiles first, then install the widget on the website. Check the dashboard daily and call new leads quickly.</p>
            </section>
        </div>
    </div>
</x-app-layout>
