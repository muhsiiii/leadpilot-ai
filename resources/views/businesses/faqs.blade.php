<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">FAQs</h2>
            <p class="mt-1 text-sm text-gray-600">Teach the assistant the answers your staff repeat every day.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
            <form method="POST" action="{{ route('businesses.faqs.store', $business) }}" class="space-y-4 rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                @csrf
                <h3 class="font-semibold text-gray-950">Add FAQ</h3>
                <x-text-input name="question" class="block w-full" placeholder="Question" required />
                <textarea name="answer" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" placeholder="Answer" required></textarea>
                <button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Add FAQ</button>
            </form>

            <section class="space-y-4">
                @forelse ($business->faqs as $faq)
                    <article class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <form id="faq-update-{{ $faq->id }}" method="POST" action="{{ route('businesses.faqs.update', [$business, $faq]) }}" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <x-text-input name="question" value="{{ $faq->question }}" required class="block w-full" />
                            <textarea name="answer" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" required>{{ $faq->answer }}</textarea>
                        </form>

                        <div class="mt-3 flex justify-end gap-2">
                            <button form="faq-update-{{ $faq->id }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Save</button>
                            <form method="POST" action="{{ route('businesses.faqs.destroy', [$business, $faq]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center text-sm text-gray-500">No FAQs yet.</div>
                @endforelse
            </section>
        </div>
    </div>
</x-app-layout>
