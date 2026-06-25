<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View|RedirectResponse
    {
        $business = $request->user()->currentBusiness();

        if (! $business) {
            return redirect()->route('businesses.create');
        }

        $business = Business::query()->whereKey($business->id)->withCount([
            'leads',
            'aiMessages',
            'leads as new_leads_count' => fn($query) => $query->where('status', 'new'),
            'leads as today_leads_count' => fn($query) => $query->whereDate('created_at', today()),
        ])->firstOrFail();

        $leads = $business->leads()
            ->latest()
            ->take(25)
            ->get();

        return view('dashboard', [
            'business' => $business,
            'leads' => $leads,
        ]);
    }
}
