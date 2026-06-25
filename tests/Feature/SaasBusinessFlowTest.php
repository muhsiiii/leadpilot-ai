<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaasBusinessFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_without_a_business_is_sent_to_onboarding(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertRedirect(route('businesses.create'));
    }

    public function test_a_user_can_create_and_manage_business_knowledge(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('businesses.store'), [
                'name' => 'Bright Dental',
                'type' => 'Dental clinic',
                'email' => 'owner@example.com',
                'website' => 'https://bright.example',
                'description' => 'Family dental clinic.',
                'lead_email_notifications' => '1',
            ])
            ->assertRedirect();

        $business = Business::first();

        $this->assertSame($user->id, $business->user_id);

        $this->actingAs($user)
            ->post(route('businesses.services.store', $business), [
                'name' => 'Dental Cleaning',
                'description' => 'Basic cleaning and polishing.',
                'price_from' => 800,
                'is_active' => '1',
            ])
            ->assertRedirect();

        $this->actingAs($user)
            ->post(route('businesses.faqs.store', $business), [
                'question' => 'Do I need an appointment?',
                'answer' => 'Appointments are recommended.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('business_services', ['business_id' => $business->id, 'name' => 'Dental Cleaning']);
        $this->assertDatabaseHas('faqs', ['business_id' => $business->id, 'question' => 'Do I need an appointment?']);
    }

    public function test_a_business_owner_can_update_lead_status(): void
    {
        $user = User::factory()->create();
        $business = Business::create([
            'user_id' => $user->id,
            'name' => 'Bright Dental',
            'slug' => 'bright-dental',
        ]);
        $lead = Lead::create([
            'business_id' => $business->id,
            'phone' => '9876543210',
            'status' => 'new',
            'source' => 'website_chat',
        ]);

        $this->actingAs($user)
            ->patch(route('businesses.leads.status', [$business, $lead]), ['status' => 'contacted'])
            ->assertRedirect();

        $this->assertSame('contacted', $lead->refresh()->status);
    }

    public function test_the_widget_script_points_to_the_business_chat_route(): void
    {
        $this->get(route('widget.script'))
            ->assertOk()
            ->assertSee('/b', false)
            ->assertSee('encodeURIComponent', false);
    }
}
