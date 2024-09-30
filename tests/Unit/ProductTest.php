<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_product()
    {
        $product = Product::create([
            'name' => 'Sample Product',
            'image' => 'sample.jpg',
            'price' => 99.99,
            'rating' => 4.5,
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Sample Product', $product->name);
        $this->assertEquals('sample.jpg', $product->image);
        $this->assertEquals(99.99, $product->price);
        $this->assertEquals(4.5, $product->rating);
    }

    public function test_it_has_many_orders()
    {
        $product = Product::factory()->create();
        $order1 = Order::factory()->create(['product_id' => $product->id]);
        $order2 = Order::factory()->create(['product_id' => $product->id]);

        $this->assertTrue($product->orders->contains($order1));
        $this->assertTrue($product->orders->contains($order2));
        $this->assertEquals(2, $product->orders->count());
    }
}