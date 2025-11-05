<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Clinic_User extends Model
{
    protected $table = 'clinic_users';

    protected $fillable = [
        'user_name',
        'email',
        'user_phone',
        'joined_date',
        'user_status',
    ];

    public function getJoinedDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}

