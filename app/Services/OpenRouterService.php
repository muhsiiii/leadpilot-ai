<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    public function chat(array $messages): string
    {
        $response = Http::timeout(30)
            ->withHeaders([
                'Authorization' => 'Bearer ' . config('services.openrouter.key'),
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => config('app.name'),
            ])
            ->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => config('services.openrouter.model'),
                'messages' => $messages,
                'temperature' => 0.4,
                'max_tokens' => 500,
            ]);

        if ($response->failed()) {
            Log::error('OpenRouter API failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return 'Sorry, AI service is temporarily unavailable.';
        }

        return $response->json('choices.0.message.content')
            ?? 'Sorry, I could not generate a reply.';
    }
}
