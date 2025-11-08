<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBooking3 extends Model
{
    use HasFactory;

    protected $table = 'user_bookings';

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
        'user_id',
        'is_hidden'  // Added for soft delete functionality
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'is_hidden' => 'boolean',  // Cast to boolean
    ];

    // Relationship with User if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}