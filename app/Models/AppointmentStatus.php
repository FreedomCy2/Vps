<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    use HasFactory;

    protected $table = 'appointment_statuses';

    protected $fillable = [
        'user_booking_id',
        'status',
        'doctor_id',
    ];
}