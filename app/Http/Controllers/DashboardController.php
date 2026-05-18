<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Lead;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $business = Business::withCount([
            'leads',
            'aiMessages',
            'leads as new_leads_count' => fn($query) => $query->where('status', 'new'),
            'leads as today_leads_count' => fn($query) => $query->whereDate('created_at', today()),
        ])->first();

        $leads = Lead::with('business')
            ->latest()
            ->take(25)
            ->get();

        return view('dashboard', [
            'business' => $business,
            'leads' => $leads,
        ]);
    }
}
