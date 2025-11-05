<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    /**
     * Explicit table name (migration creates `user_bookings`).
     */
    protected $table = 'user_bookings';

    /**
     * Mass assignable fields matching the form and migration.
     */
    protected $fillable = [
        'service',
        'date',
        'time',
        'name',
        'email',
        'phone',
        'age',
        'gender',
        'symptom',
        'status',
    ];

    /**
     * Casts for convenient access. Leave time as string since DB stores time.
     */
    protected $casts = [
        'date' => 'date',
        'time' => 'string',
    ];
}
