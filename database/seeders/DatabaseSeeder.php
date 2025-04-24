<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Test Patient',
            'email' => 'patient@example.com',
            'password' => Hash::make('123456'),
        ]);

        \App\Models\MedicalRecord::factory()->create([
            'user_id' => \App\Models\User::first()->id,
            'degree_date' => Carbon::now()->subDays(rand(30, 365))->format('Y-m-d'),
        ]);
    }
}
