<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'vehicle_name',
        'vehicle_number',
        'made'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
