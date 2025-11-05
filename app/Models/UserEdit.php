<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEdit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'history_id',
        'old_service',
        'new_service',
        'new_date',
        'new_time',
        'reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function history()
    {
        return $this->belongsTo(UserHistory::class, 'history_id');
    }
}
