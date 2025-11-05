<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
    protected $table = 'doctors';

    protected $fillable = [
        'doctor_name',
        'specialization',
        'doctor_email',
        'doctor_phone',
        'doctor_status',
    ];

    // Provide a convenient `status` attribute for views that expect `$doctor->status`
    public function getStatusAttribute()
    {
        return $this->doctor_status;
    }
}
