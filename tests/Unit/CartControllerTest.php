<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartControllerTest extends TestCase
{
    // Test to display the cart contents
    public function test_cart_index()
{
    // Mock session data
    $user = User::factory()->create();
    $this->actingAs($user);


    // Call the index method
    $response = $this->get('/cart');

    // Assert the view is returned with the correct cart data
    $response->assertStatus(200);
    $response->assertViewHas('cart');
}


    // Test for counting the total number of items in the cart
    public function test_cart_count()
    {
        // Mock session data for the cart
        Session::shouldReceive('get')
            ->with('cart', [])
            ->andReturn([
                1 => ['quantity' => 1],
                2 => ['quantity' => 2]
            ]);

        // Call the count method
        $response = $this->getJson('/cart/count');

        // Assert the correct count is returned
        $response->assertStatus(200);
        $response->assertJson(['count' => 3]);  // 1 + 2 = 3 items
    }

    // Test for adding a product to the cart
    public function test_add_product_to_cart()
    {
        // Mock the session
        $sessionMock = \Mockery::mock(\Illuminate\Session\SessionManager::class);
        $sessionMock->shouldReceive('get')
            ->andReturn([]); // return empty array as the cart is initially empty
        $sessionMock->shouldReceive('put')
            ->andReturn(true); // mock the session put method
    
        $this->app->instance('session', $sessionMock);
    
        // Mock the product
        $product = Product::factory()->create();
    
        // Call the add method
        $response = $this->postJson('/cart/add', ['id' => $product->id]);
    
        // Assert the product is added to the cart
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Product added to cart']);
    }
    
    

    // Test for updating the quantity of a product in the cart
    public function test_update_product_in_cart()
    {
        // Create a mock user and product
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Mock authentication
        $this->actingAs($user);

        // Mock session data for the cart
        Session::shouldReceive('get')
            ->andReturn([$product->id => ['quantity' => 1]]);
        Session::shouldReceive('put')->once();

        // Mock database update
        Cart::shouldReceive('where->where->update')->andReturn(true);

        // Call the update method
        $response = $this->putJson('/cart/update', ['id' => $product->id, 'quantity' => 3]);

        // Assert the product quantity is updated
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }

    // Test for removing a product from the cart
    public function test_remove_product_from_cart()
    {
        // Create a mock user and product
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Mock authentication
        $this->actingAs($user);

        // Mock session data for the cart
        Session::shouldReceive('get')
            ->andReturn([$product->id => ['quantity' => 1]]);
        Session::shouldReceive('put')->once();

        // Mock database delete
        Cart::shouldReceive('where->where->delete')->andReturn(true);

        // Call the remove method
        $response = $this->deleteJson('/cart/remove', ['id' => $product->id]);

        // Assert the product is removed from the cart
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    }
}
