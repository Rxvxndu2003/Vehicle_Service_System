<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserVehicle;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Mockery;



class VehicleControllerTest extends TestCase
{
    /**
     * Test the index method returns the correct data.
     */

     public function test_index_returns_vehicles_for_authenticated_user()
     {
         // Mock the authenticated user
         $user = User::factory()->create();
         
         // Mock the guard() and related methods
         Auth::shouldReceive('guard')->andReturnSelf();
         Auth::shouldReceive('user')->andReturn($user);
         Auth::shouldReceive('id')->andReturn($user->id);
         Auth::shouldReceive('check')->andReturn(true); // Mock the check method
 
         // Mock the user vehicles
         $vehicles = UserVehicle::factory()->count(3)->create(['user_id' => $user->id]);
 
         // Call the index method
         $response = $this->get(route('vehicles.index'));
 
         // Assert that the correct view is returned with the right data
         $response->assertStatus(200);
         $response->assertViewIs('pages.vehicle');
         $response->assertViewHas('users', $user);
         $response->assertViewHas('vehicles', $vehicles);
     }
    /**
     * Test the store method.
     */
public function test_store_adds_vehicle_for_authenticated_user()
{
    $user = User::factory()->create();
    $this->actingAs($user);

    $vehicleData = [
        'user_id' => $user->id,
        'full_name' => 'John Doe',
        'vehicle_name' => 'Toyota Prius',
        'vehicle_number' => 'ABC1234',
        'made' => '2020-01-01', // Provide a valid date format
    ];

    $response = $this->post(route('vehicles.store'), $vehicleData);

    // Assert that the vehicle is stored and redirected properly
    $this->assertDatabaseHas('user_vehicles', [
        'user_id' => $user->id,
        'full_name' => 'John Doe',
        'vehicle_name' => 'Toyota Prius',
        'vehicle_number' => 'ABC1234',
        'made' => '2020-01-01', // Update the assertion
    ]);
}
    /**
     * Test the destroy method deletes a vehicle.
     */
    public function test_destroy_deletes_vehicle_for_authenticated_user()
    {
        // Mock the authenticated user
        $user = User::factory()->create();
        Auth::shouldReceive('id')->andReturn($user->id);

        // Create a vehicle for the user
        $vehicle = UserVehicle::factory()->create(['user_id' => $user->id]);

        // Call the destroy method
        $response = $this->delete(route('vehicles.destroy', $vehicle->id));

        // Assert that the vehicle is deleted
        $this->assertDatabaseMissing('user_vehicles', ['id' => $vehicle->id]);

        // Assert that the user is redirected with a success message
        $response->assertRedirect();
        $response->assertSessionHas('message', 'Vehicle delete successfully.');
    }
    /**
     * Test the destroy method prevents deleting another user's vehicle.
     */
    public function test_destroy_prevents_deleting_other_users_vehicle()
    {
        // Mock the authenticated user
        $user = User::factory()->create();
        Auth::shouldReceive('id')->andReturn($user->id);

        // Create a vehicle for a different user
        $otherUser = User::factory()->create();
        $vehicle = UserVehicle::factory()->create(['user_id' => $otherUser->id]);

        // Call the destroy method
        $response = $this->delete(route('vehicles.destroy', $vehicle->id));

        // Assert that the vehicle is not deleted
        $this->assertDatabaseHas('user_vehicles', ['id' => $vehicle->id]);

        // Assert that the user is redirected with an error message
        $response->assertRedirect();
        $response->assertSessionHas('error', 'You are not authorized to delete this vehicle.');
    }
}
