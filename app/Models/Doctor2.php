<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor2 extends Model
{
    use HasFactory;

    // Specify the table name if it's different from model name
    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'phone',
        'specialization',
        'start_time',
        'end_time',
        'appointment_duration',
        'profile_picture',
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];
}