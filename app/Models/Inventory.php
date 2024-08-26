<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Suppliers;

class Inventory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'supplier_id',
        'product_name',
        'category',
        'quantity',
        'date_of_add',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Suppliers::class);
    }
}
