<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function create(): View
    {
        return view('businesses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $business = $request->user()->businesses()->create($this->validatedBusiness($request));

        return redirect()
            ->route('businesses.services.index', $business)
            ->with('status', 'business-created');
    }

    public function edit(Request $request, Business $business): View
    {
        $this->authorizeBusiness($request, $business);

        return view('businesses.edit', [
            'business' => $business,
        ]);
    }

    public function update(Request $request, Business $business): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);

        $business->update($this->validatedBusiness($request, $business));

        return back()->with('status', 'business-updated');
    }

    public function install(Request $request, Business $business): View
    {
        $this->authorizeBusiness($request, $business);

        return view('businesses.install', [
            'business' => $business,
        ]);
    }

    public function billing(Request $request, Business $business): View
    {
        $this->authorizeBusiness($request, $business);

        return view('businesses.billing', [
            'business' => $business,
            'plans' => config('plans'),
        ]);
    }

    public function updatePlan(Request $request, Business $business): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);

        $validated = $request->validate([
            'plan' => ['required', Rule::in(['starter', 'growth', 'pro'])],
        ]);

        $plan = config("plans.{$validated['plan']}");

        $business->update([
            'plan' => $validated['plan'],
            'subscription_status' => 'trial',
            'monthly_conversation_limit' => $plan['conversation_limit'],
        ]);

        return back()->with('status', 'plan-updated');
    }

    private function validatedBusiness(Request $request, ?Business $business = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'opening_hours' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:2000'],
            'ai_instructions' => ['nullable', 'string', 'max:2000'],
            'lead_email_notifications' => ['nullable', 'boolean'],
        ]);

        $validated['lead_email_notifications'] = $request->boolean('lead_email_notifications', true);

        if (! $business || $business->name !== $validated['name']) {
            $validated['slug'] = $this->uniqueSlug($validated['name'], $business);
        }

        return $validated;
    }

    private function uniqueSlug(string $name, ?Business $business = null): string
    {
        $base = Str::slug($name) ?: 'business';
        $slug = $base;
        $counter = 2;

        while (Business::query()
            ->where('slug', $slug)
            ->when($business, fn ($query) => $query->whereKeyNot($business->id))
            ->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    private function authorizeBusiness(Request $request, Business $business): void
    {
        abort_unless($business->user_id === $request->user()->id, 403);
    }
}
