<?php

namespace Tests\Feature;

use App\Models\Services;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching all services.
     */
    public function test_fetch_all_services()
    {
        // Disable authentication middleware for the test
        $this->withoutMiddleware();

        // Create some services in the database
        Services::factory()->count(3)->create();

        // Make a request to the index endpoint
        $response = $this->getJson('/api/services');

        // Assert the status and JSON structure
        $response->assertStatus(200);

        // Assert that 3 services are returned in the JSON response
        $response->assertJsonCount(3);

        // Optionally, assert the structure of each service
        $response->assertJsonStructure([
            '*' => [
                'id',
                'service_name',
            ],
        ]);
    }
}
