<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Http\Request;
use Mockery;

class ProductControllerTest extends TestCase
{
    public function test_fetch_products_success()
    {
        // Create a mock for the Product model
        $productMock = Mockery::mock('overload:App\Models\Product');
        
        // Set expectations for the Product::all() method to return a collection of products
        $productMock->shouldReceive('all')->once()->andReturn(collect([
            (object) ['id' => 1, 'name' => 'Product 1', 'image' => 'image1.jpg', 'rating' => 4.5, 'price' => 100],
            (object) ['id' => 2, 'name' => 'Product 2', 'image' => 'image2.jpg', 'rating' => 4.0, 'price' => 200],
            (object) ['id' => 3, 'name' => 'Product 3', 'image' => 'image3.jpg', 'rating' => 3.5, 'price' => 300],
        ]));
    
        // Call the fetchProducts method
        $controller = new \App\Http\Controllers\ProductController();
        $request = Request::create('/products', 'GET');
        $response = $controller->fetchProducts($request);
    
        // Assert the response is a JSON with the product data
        $this->assertEquals(200, $response->status());
        $this->assertCount(3, $response->getData(true)); // Check that 3 products are returned
    }
    public function test_show_product_success()
{
    // Mock the Product model
    $productMock = Mockery::mock('overload:App\Models\Product');

    // Mock the Product::findOrFail() method to return a fake product
    $productMock->shouldReceive('findOrFail')->with(1)->once()->andReturn((object) [
        'id' => 1,
        'name' => 'Test Product',
        'image' => 'image1.jpg',
        'rating' => 4.5,
        'price' => 100,
    ]);

    // Call the show method of the controller
    $controller = new \App\Http\Controllers\ProductController();
    $response = $controller->show(1);

    // Assert that the correct view is returned
    $this->assertEquals('pages.item', $response->getName());

    // Assert that the view has the correct product data
    $this->assertArrayHasKey('product', $response->getData());
    $this->assertEquals(1, $response->getData()['product']->id);
    $this->assertEquals('Test Product', $response->getData()['product']->name);
    $this->assertEquals('image1.jpg', $response->getData()['product']->image);
    $this->assertEquals(4.5, $response->getData()['product']->rating);
    $this->assertEquals(100, $response->getData()['product']->price);
}

}
