<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service', 'date', 'time', 'name', 'email', 'phone', 'age', 'gender', 'symptom'
    ];
}
