<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service',
        'doctor',
        'date',
        'time',
        'status',
        'medical_concern',
        'symptoms',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edits()
    {
        return $this->hasMany(UserEdit::class, 'history_id');
    }
}
