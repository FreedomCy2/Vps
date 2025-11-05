<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Legacy/backup model left by a previous contributor. Renamed to avoid class name collision.
class DoctorBackup extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'doctor_name',
        'specialization',
        'doctor_email',
        'doctor_phone',
        'doctor_status',
    ];
}
