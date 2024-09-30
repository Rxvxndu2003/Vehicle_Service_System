<?php

namespace Database\Factories;

use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCenterFactory extends Factory
{
    protected $model = ServiceCenter::class;

    public function definition()
    {
        return [
            'service_center' => $this->faker->company,
            'location' => $this->faker->address,
            // Add other fields if necessary
        ];
    }
}

