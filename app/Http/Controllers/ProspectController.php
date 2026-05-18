<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProspectController extends Controller
{
    public function index(): View
    {
        $prospects = Prospect::query()
            ->orderByDesc('priority_score')
            ->orderBy('business_name')
            ->get();

        return view('prospects.index', [
            'prospects' => $prospects,
            'statusCounts' => Prospect::query()
                ->selectRaw('status, count(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),
        ]);
    }

    public function updateStatus(Request $request, Prospect $prospect): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'string', 'in:research,contacted,interested,not_now,won,lost'],
        ]);

        $prospect->update([
            'status' => $validated['status'],
            'last_contacted_at' => in_array($validated['status'], ['contacted', 'interested', 'not_now', 'won', 'lost'], true)
                ? now()
                : $prospect->last_contacted_at,
        ]);

        return back();
    }
}
