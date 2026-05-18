<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\BusinessService;
use App\Models\Faq;
use Illuminate\Database\Seeder;

class DemoBusinessSeeder extends Seeder
{
    public function run(): void
    {
        $business = Business::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Care Clinic',
                'slug' => 'demo-care-clinic',
                'type' => 'Clinic',
                'phone' => '+91 9999999999',
                'address' => 'Kozhikode, Kerala',
                'opening_hours' => 'Monday to Saturday, 9 AM to 7 PM',
                'description' => 'A demo clinic offering consultation, dental cleaning, and health checkups.',
            ]
        );

        BusinessService::updateOrCreate(
            ['business_id' => $business->id, 'name' => 'General Consultation'],
            [
                'description' => 'Doctor consultation for common health issues.',
                'price_from' => 300,
            ],
        );

        BusinessService::updateOrCreate(
            ['business_id' => $business->id, 'name' => 'Dental Cleaning'],
            [
                'description' => 'Basic dental cleaning and oral hygiene service.',
                'price_from' => 800,
            ],
        );

        Faq::updateOrCreate(
            ['business_id' => $business->id, 'question' => 'Do I need appointment?'],
            ['answer' => 'Appointments are recommended, but walk-ins are accepted based on availability.'],
        );

        Faq::updateOrCreate(
            ['business_id' => $business->id, 'question' => 'What are the opening hours?'],
            ['answer' => 'We are open Monday to Saturday from 9 AM to 7 PM.'],
        );
    }
}
