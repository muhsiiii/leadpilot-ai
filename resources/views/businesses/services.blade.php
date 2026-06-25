<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Services</h2>
            <p class="mt-1 text-sm text-gray-600">Add the offers, prices, and descriptions the assistant can talk about.</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
            <form method="POST" action="{{ route('businesses.services.store', $business) }}" class="space-y-4 rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                @csrf
                <h3 class="font-semibold text-gray-950">Add service</h3>
                <x-text-input name="name" class="block w-full" placeholder="Service name" required />
                <textarea name="description" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" placeholder="Short service description"></textarea>
                <x-text-input name="price_from" type="number" step="0.01" min="0" class="block w-full" placeholder="Starting price" />
                <button class="rounded-md bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Add service</button>
            </form>

            <section class="space-y-4">
                @forelse ($business->services as $service)
                    <article class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
                        <form id="service-update-{{ $service->id }}" method="POST" action="{{ route('businesses.services.update', [$business, $service]) }}" class="space-y-3">
                            @csrf
                            @method('PATCH')
                            <div class="grid gap-3 sm:grid-cols-[1fr_10rem]">
                                <x-text-input name="name" value="{{ $service->name }}" required />
                                <x-text-input name="price_from" type="number" step="0.01" min="0" value="{{ $service->price_from }}" />
                            </div>
                            <textarea name="description" rows="2" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ $service->description }}</textarea>
                            <label class="flex items-center gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-emerald-700 focus:ring-emerald-600" @checked($service->is_active)>
                                Active in assistant
                            </label>
                        </form>

                        <div class="mt-3 flex justify-end gap-2">
                            <button form="service-update-{{ $service->id }}" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-emerald-700">Save</button>
                            <form method="POST" action="{{ route('businesses.services.destroy', [$business, $service]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="rounded-md border border-red-200 px-3 py-2 text-sm font-semibold text-red-700 hover:bg-red-50">Delete</button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center text-sm text-gray-500">No services yet.</div>
                @endforelse
            </section>
        </div>
    </div>
</x-app-layout>
