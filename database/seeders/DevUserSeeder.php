<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('DEV_ADMIN_EMAIL', 'admin@leadpilot.local')],
            [
                'name' => env('DEV_ADMIN_NAME', 'LeadPilot Admin'),
                'password' => Hash::make(env('DEV_ADMIN_PASSWORD', 'password')),
            ],
        );
    }
}
