<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_cart_item()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $cartItem = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $this->assertDatabaseHas('carts', [
            'id' => $cartItem->id,
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $cartItem = Cart::factory()->create(['user_id' => $user->id]);
        $this->assertInstanceOf(User::class, $cartItem->user);
        $this->assertEquals($user->id, $cartItem->user->id);
    }

    public function test_it_belongs_to_a_product()
    {
        $product = Product::factory()->create();
        $cartItem = Cart::factory()->create(['product_id' => $product->id]);
        $this->assertInstanceOf(Product::class, $cartItem->product);
        $this->assertEquals($product->id, $cartItem->product->id);
    }
}