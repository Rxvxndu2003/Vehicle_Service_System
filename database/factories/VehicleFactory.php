<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = Vehicle::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(), // Assumes Customer factory exists
            'vehicle_name' => $this->faker->word,
            'vehicle_number' => strtoupper($this->faker->bothify('??###')),
            'made' => $this->faker->date('Y-m-d'),
        ];
    }
}
