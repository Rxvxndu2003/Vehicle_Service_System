<?php

namespace Tests\Feature;

use App\Models\ServiceCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceCenterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching all service centers.
     */
    public function test_fetch_all_service_centers()
    {
        // Create a user and simulate login
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);
    
        // Create some service centers in the database
        ServiceCenter::factory()->count(3)->create();
    
        // Make a request to the index endpoint
        $response = $this->getJson('/api/service-centers');
    
        // Assert the status and JSON structure
        $response->assertStatus(200);
        $response->assertJsonCount(3); // Ensure 3 service centers are returned
    }
    
}

