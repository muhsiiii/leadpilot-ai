<?php

namespace App\Http\Controllers;

use App\Models\AiMessage;
use App\Models\Business;
use App\Models\Lead;
use App\Services\OpenRouterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ChatController extends Controller
{
    public function index(): View
    {
        $business = Business::with(['services', 'faqs'])->firstOrFail();

        return $this->renderChat($business);
    }

    public function show(Business $business): View
    {
        $business->load(['services', 'faqs']);

        return $this->renderChat($business);
    }

    public function send(Request $request, OpenRouterService $openRouter): JsonResponse
    {
        $business = Business::with(['services', 'faqs'])->firstOrFail();

        return $this->handleSend($request, $openRouter, $business);
    }

    public function sendForBusiness(Request $request, OpenRouterService $openRouter, Business $business): JsonResponse
    {
        $business->load(['services', 'faqs']);

        return $this->handleSend($request, $openRouter, $business);
    }

    private function renderChat(Business $business): View
    {
        return view('chat.index', [
            'business' => $business->loadMissing(['activeServices', 'faqs']),
            'sendRoute' => route('business.chat.send', $business),
        ]);
    }

    private function handleSend(Request $request, OpenRouterService $openRouter, Business $business): JsonResponse
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        AiMessage::create([
            'business_id' => $business->id,
            'role' => 'user',
            'message' => $request->message,
            'model' => config('services.openrouter.model'),
        ]);

        $reply = $openRouter->chat([
            [
                'role' => 'system',
                'content' => $this->buildSystemPrompt($business),
            ],
            [
                'role' => 'user',
                'content' => $request->message,
            ],
        ]);

        AiMessage::create([
            'business_id' => $business->id,
            'role' => 'assistant',
            'message' => $reply,
            'model' => config('services.openrouter.model'),
        ]);

        $lead = $this->tryCreateLead($business, $request->message);

        return response()->json([
            'reply' => $reply,
            'lead_captured' => $lead !== null,
        ]);
    }

    private function buildSystemPrompt(Business $business): string
    {
        $services = $business->activeServices
            ->map(fn($service) => "- {$service->name}: {$service->description}, starting from INR {$service->price_from}")
            ->implode("\n");

        $faqs = $business->faqs
            ->map(fn($faq) => "Q: {$faq->question}\nA: {$faq->answer}")
            ->implode("\n\n");

        return "
        You are an AI lead assistant for {$business->name}.

        Business type: {$business->type}
        Address: {$business->address}
        Opening hours: {$business->opening_hours}
        Description: {$business->description}
        Extra owner instructions: {$business->ai_instructions}

        Services:
        {$services}

        FAQs:
        {$faqs}

        Rules:
        1. Reply clearly and politely.
        2. Keep replies under 3 short sentences.
        3. Answer only using the business information above.
        4. When the customer shows buying intent, ask for name, phone number, service needed, and preferred date.
        5. Do not confirm appointments. Say the team will contact them.
        ";
    }

    private function tryCreateLead(Business $business, string $message): ?Lead
    {
        $phone = $this->extractPhoneFromMessage($message);

        if (! $phone) {
            return null;
        }

        return Lead::updateOrCreate(
            [
                'business_id' => $business->id,
                'phone' => $phone,
            ],
            [
                'name' => $this->extractNameFromMessage($message),
                'email' => $this->extractEmailFromMessage($message),
                'requirement' => $this->cleanRequirement($message),
                'preferred_date' => $this->extractPreferredDate($message),
                'status' => 'new',
                'source' => 'website_chat',
            ]
        );
    }

    private function extractPhoneFromMessage(string $message): ?string
    {
        preg_match('/(?:\+91[\s-]?)?([6-9]\d{9})\b/', $message, $phoneMatch);

        return $phoneMatch[1] ?? null;
    }

    private function extractNameFromMessage(string $message): ?string
    {
        $patterns = [
            '/my name is\s+([a-zA-Z][a-zA-Z\s]{1,40}?)(?=\s+(?:and|my|phone|mobile|email|for|i need)|[,.]|$)/i',
            '/name is\s+([a-zA-Z][a-zA-Z\s]{1,40}?)(?=\s+(?:and|my|phone|mobile|email|for|i need)|[,.]|$)/i',
            '/i am\s+([a-zA-Z][a-zA-Z\s]{1,40}?)(?=\s+(?:and|my|phone|mobile|email|for|i need)|[,.]|$)/i',
            '/this is\s+([a-zA-Z][a-zA-Z\s]{1,40}?)(?=\s+(?:and|my|phone|mobile|email|for|i need)|[,.]|$)/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $message, $match)) {
                return Str::of($match[1])->squish()->title()->toString();
            }
        }

        return null;
    }

    private function extractEmailFromMessage(string $message): ?string
    {
        preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $message, $emailMatch);

        return $emailMatch[0] ?? null;
    }

    private function extractPreferredDate(string $message): ?string
    {
        $lowerMessage = Str::lower($message);

        if (str_contains($lowerMessage, 'today')) {
            return today()->toDateString();
        }

        if (str_contains($lowerMessage, 'tomorrow')) {
            return today()->addDay()->toDateString();
        }

        if (preg_match('/\b(\d{1,2}[\/-]\d{1,2}(?:[\/-]\d{2,4})?)\b/', $message, $dateMatch)) {
            return $dateMatch[1];
        }

        return null;
    }

    private function cleanRequirement(string $message): string
    {
        return Str::of($message)
            ->replaceMatches('/(?:\+91[\s-]?)?[6-9]\d{9}\b/', '')
            ->replaceMatches('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', '')
            ->squish()
            ->limit(500, '')
            ->toString();
    }
}
