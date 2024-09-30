<?php
// database/factories/OrderFactory.php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'full_name' => $this->faker->name,
            'product_id' => Product::factory(),
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'phone' => $this->faker->phoneNumber,
            'payment_details' => 'Credit Card',
            'total' => $this->faker->randomFloat(2, 10, 500),
            'is_completed' => $this->faker->boolean,
        ];
    }
}