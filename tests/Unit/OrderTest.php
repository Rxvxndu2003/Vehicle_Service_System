<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_an_order()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $order = Order::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'product_id' => $product->id,
            'email' => 'john@example.com',
            'address' => '123 Main St',
            'postal_code' => '12345',
            'phone' => '1234567890',
            'payment_details' => 'Credit Card',
            'total' => 100.00,
            'is_completed' => false,
        ]);

        $this->assertInstanceOf(Order::class, $order);
    }

    public function test_it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);
        $this->assertInstanceOf(User::class, $order->user);
        $this->assertEquals($user->id, $order->user->id);
    }

    public function test_it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $order = Order::factory()->create(['product_id' => $product->id]);
        $this->assertInstanceOf(Product::class, $order->product);
        $this->assertEquals($product->id, $order->product->id);
    }
}