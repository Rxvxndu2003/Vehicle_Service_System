<?php

namespace Database\Factories;

use App\Models\Appointments;
use App\Models\Customer;
use App\Models\ServiceCenter;
use App\Models\Services;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentsFactory extends Factory
{
    protected $model = Appointments::class;

    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'service_center_id' => ServiceCenter::factory(),
            'services_id' => Services::factory(),
            'location' => $this->faker->address,
            'schedule_date' => $this->faker->date,
            'schedule_time' => $this->faker->time,
            'is_completed' => false,
        ];
    }
}
