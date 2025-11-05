<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // 👈 tell Laravel to use bookings table

    protected $fillable = [
        'patient_name',
        'doctor_name',
        'appointment_date',
        'appointment_time',
        'status',
    ];
}
