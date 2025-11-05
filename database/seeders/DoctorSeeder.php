<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data
        Doctor::insert([
            'doctor_name' => 'Dr. John Smith',
            'specialization' => 'Cardiology',
            'doctor_email' => 'john.smith@example.com',
            'doctor_phone' => '123-456-7890',
            'doctor_status' => 'active',
        ]);
    }
};
