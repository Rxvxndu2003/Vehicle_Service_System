<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     */
    public function test_index1_method()
{
    // Create a user and simulate login
    $user = \App\Models\User::factory()->create();
    $this->actingAs($user);

    // Simulate cart items in session with the required 'image' key
    Session::put('cart', [
        1 => [
            'name' => 'Product 1',
            'quantity' => 2,
            'price' => 100,
            'image' => 'img/about.jpg' // Add the 'image' key
        ]
    ]);

    $response = $this->get('/cart');

    $response->assertStatus(200);
    $response->assertViewHas('cart');
}

    /**
     * Test count method.
     */
    public function test_count_method()
    {
        // Simulate cart with multiple items in session
        Session::put('cart', [
            1 => ['quantity' => 2],
            2 => ['quantity' => 3]
        ]);

        $response = $this->getJson('/cart/count');

        $response->assertStatus(200)
            ->assertJson(['count' => 5]);
    }

    /**
     * Test add method when user is not logged in.
     */
    public function test_add_method_user_not_logged_in()
    {
        $response = $this->postJson('/cart/add', ['id' => 1]);
    
        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']); // Default Laravel message
    }
    

    /**
     * Test add method when user is logged in.
     */
    public function test_add_method_user_logged_in()
    {
        // Create a user and a product
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Log in as the user
        $this->actingAs($user);

        $response = $this->postJson('/cart/add', ['id' => $product->id]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Product added to cart']);

        // Check if the product is in the session and in the database
        $this->assertEquals(1, session('cart')[$product->id]['quantity']);
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
    }

    /**
     * Test update method.
     */
    public function test_update_method()
{
    // Create a user and a product
    $user = User::factory()->create();
    $product = Product::factory()->create();

    // Simulate the user being logged in and product in the cart
    $this->actingAs($user);

    // Add the product to the cart in the session
    Session::put('cart', [
        $product->id => ['quantity' => 1, 'price' => $product->price]
    ]);

    // Add product to the cart in the database
    \App\Models\Cart::create([
        'user_id' => $user->id,
        'product_id' => $product->id,
        'quantity' => 1
    ]);

    // Perform the update action
    $response = $this->postJson('/cart/update', [
        'id' => $product->id,
        'quantity' => 3
    ]);

    $response->assertStatus(200)
        ->assertJson(['success' => true]);

    // Verify the cart in the session and the database
    $this->assertEquals(3, session('cart')[$product->id]['quantity']);
    $this->assertDatabaseHas('carts', [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'quantity' => 3
    ]);
}


    /**
     * Test remove method.
     */
    public function test_remove_method()
    {
        // Create a user and a product
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // Simulate the user being logged in and product in the cart
        $this->actingAs($user);
        Session::put('cart', [
            $product->id => ['quantity' => 1, 'price' => $product->price]
        ]);

        // Add product to database cart
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $response = $this->postJson('/cart/remove', ['id' => $product->id]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        // Check the session and database to ensure the product was removed
        $this->assertFalse(isset(session('cart')[$product->id]));
        $this->assertDatabaseMissing('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id
        ]);
    }
}
