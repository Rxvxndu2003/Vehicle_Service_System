<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'laramongo';
    protected $collection = 'addresses';
    protected $fillable = ['street', 'city', 'state', 'country', 'postal_code'];
}
