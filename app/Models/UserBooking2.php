<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserBooking2 extends Model
{
    use HasFactory;

    protected $table = 'user_bookinghistory';

    protected $fillable = [
        'user_id',
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

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
        'age' => 'integer',
    ];

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, $status)
    {
        if ($status) {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope to filter by user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if booking can be edited
     */
    public function canBeEdited()
    {
        return !in_array($this->status, ['Done', 'Cancelled']);
    }

    /**
     * Check if booking can be cancelled
     */
    public function canBeCancelled()
    {
        return !in_array($this->status, ['Done', 'Cancelled']);
    }
}