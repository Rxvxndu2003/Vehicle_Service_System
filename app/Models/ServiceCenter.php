<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointments;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Services;

class ServiceCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_center',
        'location',
    ];

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointments::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Services::class);
    }
}
