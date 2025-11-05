<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clinic_User;

class ClinicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert seed data here
        Clinic_User::insert([
            'user_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'user_phone' => '123-456-7890',
            'joined_date' => '2023-01-15',
            'user_status' => 'active',
        ]);
    }
}
