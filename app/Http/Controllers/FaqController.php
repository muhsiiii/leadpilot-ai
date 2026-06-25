<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request, Business $business): View
    {
        $this->authorizeBusiness($request, $business);

        return view('businesses.faqs', [
            'business' => $business->load('faqs'),
        ]);
    }

    public function store(Request $request, Business $business): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);

        $business->faqs()->create($this->validatedFaq($request));

        return back()->with('status', 'faq-created');
    }

    public function update(Request $request, Business $business, Faq $faq): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);
        abort_unless($faq->business_id === $business->id, 404);

        $faq->update($this->validatedFaq($request));

        return back()->with('status', 'faq-updated');
    }

    public function destroy(Request $request, Business $business, Faq $faq): RedirectResponse
    {
        $this->authorizeBusiness($request, $business);
        abort_unless($faq->business_id === $business->id, 404);

        $faq->delete();

        return back()->with('status', 'faq-deleted');
    }

    private function validatedFaq(Request $request): array
    {
        return $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:1000'],
        ]);
    }

    private function authorizeBusiness(Request $request, Business $business): void
    {
        abort_unless($business->user_id === $request->user()->id, 403);
    }
}
