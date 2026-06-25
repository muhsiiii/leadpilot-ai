<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function updateStatus(Request $request, Business $business, Lead $lead): RedirectResponse
    {
        abort_unless($business->user_id === $request->user()->id, 403);
        abort_unless($lead->business_id === $business->id, 404);

        $validated = $request->validate([
            'status' => ['required', Rule::in(['new', 'contacted', 'qualified', 'won', 'lost'])],
        ]);

        $lead->update($validated);

        return back()->with('status', 'lead-updated');
    }
}
