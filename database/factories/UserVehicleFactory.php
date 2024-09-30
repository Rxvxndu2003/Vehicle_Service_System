<?php
// database/factories/UserVehicleFactory.php

namespace Database\Factories;

use App\Models\UserVehicle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserVehicleFactory extends Factory
{
    protected $model = UserVehicle::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'full_name' => $this->faker->name,
            'vehicle_name' => $this->faker->word,
            'vehicle_number' => $this->faker->bothify('???###'),
            'made' => $this->faker->date('Y-m-d'),
        ];
    }
}