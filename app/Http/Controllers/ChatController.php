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
    public function show(Business $business): View
    {
        $business->load(['services', 'faqs']);

        return $this->renderChat($business);
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
            'visitor_token' => ['nullable', 'string', 'max:80'],
        ]);

        $visitorToken = $request->filled('visitor_token')
            ? Str::of($request->string('visitor_token'))->replaceMatches('/[^a-zA-Z0-9_-]/', '')->limit(80, '')->toString()
            : null;

        AiMessage::create([
            'business_id' => $business->id,
            'visitor_token' => $visitorToken,
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
            'visitor_token' => $visitorToken,
            'role' => 'assistant',
            'message' => $reply,
            'model' => config('services.openrouter.model'),
        ]);

        $lead = $this->tryCreateLead($business, $request->message, $visitorToken);

        return response()->json([
            'reply' => $reply,
            'lead_captured' => $lead !== null,
        ]);
    }

    private function buildSystemPrompt(Business $business): string
    {
        $services = $business->activeServices
            ->map(fn ($service) => "- {$service->name}: {$service->description}, starting from INR {$service->price_from}")
            ->implode("\n");

        $faqs = $business->faqs
            ->map(fn ($faq) => "Q: {$faq->question}\nA: {$faq->answer}")
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

    private function tryCreateLead(Business $business, string $message, ?string $visitorToken): ?Lead
    {
        $leadContext = $this->buildLeadContext($business, $message, $visitorToken);
        $phone = $this->extractPhoneFromMessage($leadContext);

        if (! $phone) {
            return null;
        }

        return Lead::updateOrCreate(
            [
                'business_id' => $business->id,
                'phone' => $phone,
            ],
            [
                'visitor_token' => $visitorToken,
                'name' => $this->extractNameFromMessage($leadContext),
                'email' => $this->extractEmailFromMessage($leadContext),
                'requirement' => $this->cleanRequirement($leadContext),
                'preferred_date' => $this->extractPreferredDate($leadContext),
                'status' => 'new',
                'source' => 'website_chat',
            ]
        );
    }

    private function buildLeadContext(Business $business, string $message, ?string $visitorToken): string
    {
        if (! $visitorToken) {
            return $message;
        }

        $messages = AiMessage::query()
            ->where('business_id', $business->id)
            ->where('visitor_token', $visitorToken)
            ->where('role', 'user')
            ->latest()
            ->take(8)
            ->pluck('message')
            ->reverse();

        return $messages->isNotEmpty() ? $messages->implode("\n") : $message;
    }

    private function extractPhoneFromMessage(string $message): ?string
    {
        $candidate = '(?:\+?\d[\d\s().-]{5,}\d)';
        $withCue = '/\b(?:phone|mobile|number|contact|call|whatsapp|wa)\b\s*(?:number)?\s*(?:is|:|-)?\s*('.$candidate.')/i';

        if (preg_match_all($withCue, $message, $matches)) {
            foreach ($matches[1] as $match) {
                $phone = $this->normalizePhone($match, minDigits: 7);

                if ($phone) {
                    return $phone;
                }
            }
        }

        if (preg_match_all('/(?<!\d)'.$candidate.'(?!\d)/', $message, $matches)) {
            foreach ($matches[0] as $match) {
                $phone = $this->normalizePhone($match, minDigits: 10);

                if ($phone) {
                    return $phone;
                }
            }
        }

        return null;
    }

    private function normalizePhone(string $phone, int $minDigits): ?string
    {
        $hasPlus = str_starts_with(trim($phone), '+');
        $digits = preg_replace('/\D+/', '', $phone);

        if (! $digits || strlen($digits) < $minDigits || strlen($digits) > 15) {
            return null;
        }

        return $hasPlus ? '+'.$digits : $digits;
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
                return Str::of($match[1])
                    ->replaceMatches('/\b(?:and|my|phone|mobile|number|email|for|i need|contact|call|whatsapp)\b.*$/i', '')
                    ->squish()
                    ->title()
                    ->toString();
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
            ->replaceMatches('/\b(?:phone|mobile|number|contact|call|whatsapp|wa)\b\s*(?:number)?\s*(?:is|:|-)?\s*(?:\+?\d[\d\s().-]{5,}\d)/i', '')
            ->replaceMatches('/(?<!\d)(?:\+?\d[\d\s().-]{8,}\d)(?!\d)/', '')
            ->replaceMatches('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', '')
            ->squish()
            ->limit(500, '')
            ->toString();
    }
}
