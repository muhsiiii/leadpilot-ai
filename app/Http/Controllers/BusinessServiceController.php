<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessServiceController extends Controller
{
    public function index(Request $request, Business $business): View
    {
        $this->authorizeBusiness($request, $business);

        return view('businesses.services', [
            'business' => $business->load('services'),
        ]);
    }

    public function store(Request $request, Business $business): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);

        $business->services()->create($this->validatedService($request));

        return back()->with('status', 'service-created');
    }

    public function update(Request $request, Business $business, BusinessService $service): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);
        abort_unless($service->business_id === $business->id, 404);

        $service->update($this->validatedService($request));

        return back()->with('status', 'service-updated');
    }

    public function destroy(Request $request, Business $business, BusinessService $service): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);
        abort_unless($service->business_id === $business->id, 404);

        $service->delete();

        return back()->with('status', 'service-deleted');
    }

    private function validatedService(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price_from' => ['nullable', 'numeric', 'min:0', 'max:99999999'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        return $validated;
    }

    private function authorizeBusiness(Request $request, Business $business): void
    {
        abort_unless($business->user_id === $request->user()->id, 403);
    }
}
