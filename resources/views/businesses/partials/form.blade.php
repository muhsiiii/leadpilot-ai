<div>
    <x-input-label for="name" value="Business name" />
    <x-text-input id="name" name="name" class="mt-1 block w-full" value="{{ old('name', $business?->name) }}" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <x-input-label for="type" value="Business type" />
        <x-text-input id="type" name="type" class="mt-1 block w-full" value="{{ old('type', $business?->type) }}" placeholder="Dental clinic, salon, agency" />
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="phone" value="Business phone" />
        <x-text-input id="phone" name="phone" class="mt-1 block w-full" value="{{ old('phone', $business?->phone) }}" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>
</div>

<div class="grid gap-4 sm:grid-cols-2">
    <div>
        <x-input-label for="email" value="Business email" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email', $business?->email) }}" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div>
        <x-input-label for="website" value="Website" />
        <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" value="{{ old('website', $business?->website) }}" placeholder="https://example.com" />
        <x-input-error :messages="$errors->get('website')" class="mt-2" />
    </div>
</div>

<div>
    <x-input-label for="address" value="Address" />
    <textarea id="address" name="address" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('address', $business?->address) }}</textarea>
    <x-input-error :messages="$errors->get('address')" class="mt-2" />
</div>

<div>
    <x-input-label for="opening_hours" value="Opening hours" />
    <textarea id="opening_hours" name="opening_hours" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('opening_hours', $business?->opening_hours) }}</textarea>
    <x-input-error :messages="$errors->get('opening_hours')" class="mt-2" />
</div>

<div>
    <x-input-label for="description" value="Short description" />
    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600">{{ old('description', $business?->description) }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
</div>

<div>
    <x-input-label for="ai_instructions" value="Extra AI instructions" />
    <textarea id="ai_instructions" name="ai_instructions" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-600 focus:ring-emerald-600" placeholder="Example: Always ask dental implant leads whether they want a consultation.">{{ old('ai_instructions', $business?->ai_instructions) }}</textarea>
    <x-input-error :messages="$errors->get('ai_instructions')" class="mt-2" />
</div>

<label class="flex items-center gap-2 text-sm text-gray-700">
    <input type="checkbox" name="lead_email_notifications" value="1" class="rounded border-gray-300 text-emerald-700 focus:ring-emerald-600" @checked(old('lead_email_notifications', $business?->lead_email_notifications ?? true))>
    Email me when a new lead is captured
</label>
