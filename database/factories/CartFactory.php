<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Automatically creates a user
            'product_id' => Product::factory(), // Automatically creates a product
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
        ];
    }
}
