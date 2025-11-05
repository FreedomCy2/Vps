<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;

    protected $table = 'booking_history';

    protected $fillable = [
        'original_booking_id',
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
        'action_type',
        'action_date',
        'doctor_name',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'time' => 'string',
        'action_date' => 'datetime',
    ];

    /**
     * Create history record from booking
     */
    public static function createFromBooking(Booking $booking, string $actionType, string $doctorName = null, string $notes = null)
    {
        return self::create([
            'original_booking_id' => $booking->id,
            'service' => $booking->service,
            'date' => $booking->date,
            'time' => $booking->time,
            'name' => $booking->name,
            'email' => $booking->email,
            'phone' => $booking->phone,
            'age' => $booking->age,
            'gender' => $booking->gender,
            'symptom' => $booking->symptom,
            'status' => $booking->status ?? 'pending',
            'action_type' => $actionType,
            'action_date' => now(),
            'doctor_name' => $doctorName,
            'notes' => $notes,
        ]);
    }

    /**
     * Get status badge class for UI
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'accepted' => 'bg-green-100 text-green-800',
            'declined' => 'bg-red-100 text-red-800',
            'deleted' => 'bg-gray-100 text-gray-800',
            default => 'bg-yellow-100 text-yellow-800'
        };
    }

    /**
     * Get action type badge class for UI
     */
    public function getActionBadgeClassAttribute()
    {
        return match($this->action_type) {
            'status_change' => 'bg-blue-100 text-blue-800',
            'deletion' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}