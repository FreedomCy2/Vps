<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_informations';

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
    ];
}
