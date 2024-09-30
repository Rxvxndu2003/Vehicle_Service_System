<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching all products.
     */
    public function test_fetch_products()
    {
        // Create some products in the database
        Product::factory()->count(3)->create();

        // Make a request to the fetchProducts endpoint
        $response = $this->getJson('/fetch-products');

        // Assert the status and JSON structure
        $response->assertStatus(200);
        $response->assertJsonCount(3); // Ensure we have 3 products in the response
    }

   
}  