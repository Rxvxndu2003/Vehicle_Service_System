<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'service_center_id',
        'service_id',
        'location',
        'schedule_date',
        'schedule_time',
        'is_completed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenter::class);
    }

    public function services()
    {
        return $this->belongsTo(Services::class);
    }
}