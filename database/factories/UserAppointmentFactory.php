<?php

namespace Database\Factories;

use App\Models\UserAppointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAppointmentFactory extends Factory
{
    protected $model = UserAppointment::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(), // Associate it with a User
            'full_name' => $this->faker->name,
            'service_center_id' => 1,  // Example value, adjust as necessary
            'services_id' => 2,        // Example value, adjust as necessary
            'location' => $this->faker->address,
            'schedule_date' => $this->faker->date(),
            'schedule_time' => $this->faker->time(),
        ];
    }
}
