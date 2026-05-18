<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\BusinessService;
use App\Models\Faq;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ChatLeadCaptureTest extends TestCase
{
    use RefreshDatabase;

    public function test_chat_captures_a_callback_ready_lead(): void
    {
        Http::fake([
            'openrouter.ai/*' => Http::response([
                'choices' => [
                    [
                        'message' => [
                            'content' => 'Thanks Vijay. Our team will contact you shortly.',
                        ],
                    ],
                ],
            ]),
        ]);

        $business = Business::create([
            'name' => 'Demo Care Clinic',
            'slug' => 'demo-care-clinic',
            'type' => 'Clinic',
            'description' => 'A clinic for consultations and dental services.',
        ]);

        BusinessService::create([
            'business_id' => $business->id,
            'name' => 'Dental Cleaning',
            'description' => 'Basic dental cleaning.',
            'price_from' => 800,
        ]);

        Faq::create([
            'business_id' => $business->id,
            'question' => 'Do I need appointment?',
            'answer' => 'Appointments are recommended.',
        ]);

        $response = $this->postJson(route('business.chat.send', $business), [
            'message' => 'I need dental cleaning tomorrow. My name is Vijay and my phone is 9876543210, email vijay@example.com',
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'reply' => 'Thanks Vijay. Our team will contact you shortly.',
                'lead_captured' => true,
            ]);

        $this->assertDatabaseHas('leads', [
            'business_id' => $business->id,
            'name' => 'Vijay',
            'phone' => '9876543210',
            'email' => 'vijay@example.com',
            'preferred_date' => today()->addDay()->toDateString(),
            'status' => 'new',
        ]);

        $this->assertSame(1, Lead::count());
    }
}
