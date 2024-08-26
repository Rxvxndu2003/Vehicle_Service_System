<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ServiceCenter;
use App\Models\Appointments;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_center_id',
        'service_name',
        'location',
        'description',
        'price',
    ];

    public function service_center(): BelongsTo
    {
        return $this->belongsTo(ServiceCenter::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointments::class);
    }
}


