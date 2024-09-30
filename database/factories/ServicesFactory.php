<?php

namespace Database\Factories;

use App\Models\Services;
use App\Models\ServiceCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicesFactory extends Factory
{
    protected $model = Services::class;

    public function definition()
    {
        return [
            'service_center_id' => ServiceCenter::factory(), // Generate a related ServiceCenter
            'service_name' => $this->faker->jobTitle,
            'location' => $this->faker->address,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 50, 1000), // Generate random price
        ];
    }
}


