<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if ($this->command->getLaravel()->environment('local')) {
            $this->call(DevUserSeeder::class);
        }
    }
}
