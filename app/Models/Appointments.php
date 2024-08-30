<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;
use App\Models\ServiceCenter;
use App\Models\Services;


class Appointments extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'service_center_id',
        'services_id',
        'location',
        'schedule_date',
        'schedule_time',
        'is_completed'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function service_center(): BelongsTo
    {
        return $this->belongsTo(ServiceCenter::class);
    }

    public function services(): BelongsTo
    {
        return $this->belongsTo(Services::class);
    }
}
