<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminBooking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminBooking::insert([
            'patient_name' => 'John Doe',
            'doctor_name' => 'Dr. Smith',
            'appointment_date' => '2025-10-22',
            'appointment_time' => '2025-10-22 10:00:00',
            'status' => 'confirmed',
        ]);
    }
}
