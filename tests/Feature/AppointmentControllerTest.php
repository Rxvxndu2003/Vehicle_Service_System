<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserAppointment;
use App\Models\ServiceCenter;
use App\Models\Services;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test index method (Listing appointments).
     */
    public function test_index_method()
    {
        // Create a user
        $user = User::factory()->create();

        // Create service centers and services
        ServiceCenter::factory()->count(3)->create();
        Services::factory()->count(3)->create();

        // Act as the user and call the index route
        $response = $this->actingAs($user)->get('/appointments');

        // Check if the response is successful and contains necessary data
        $response->assertStatus(200);
        $response->assertViewHas('serviceCenters');
        $response->assertViewHas('services');
    }

    /**
     * Test store method (Creating an appointment).
     */
    public function test_store_method()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a service center and service
        $serviceCenter = ServiceCenter::factory()->create();
        $service = Services::factory()->create();

        // Act as the user and send a POST request to store an appointment
        $response = $this->actingAs($user)->post('/appointments', [
            'full_name' => 'John Doe',
            'service_center_id' => $serviceCenter->id,
            'services_id' => $service->id,
            'location' => '123 Main St',
            'schedule_date' => '2024-09-15',
            'schedule_time' => '10:00:00',
        ]);

        // Check if the appointment was stored successfully and redirected to the index page
        $response->assertRedirect('/appointments');
        $response->assertSessionHas('message', 'Appointment created successfully');

        // Verify that the appointment exists in the database
        $this->assertDatabaseHas('user_appointments', [
            'full_name' => 'John Doe',
            'location' => '123 Main St'
        ]);
    }

    /**
     * Test destroy method (Cancelling an appointment).
     */
    public function test_destroy_method()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a service center and a service
        $serviceCenter = ServiceCenter::factory()->create();
        $service = Services::factory()->create([
            'service_center_id' => $serviceCenter->id,  // Ensure the foreign key relationship
        ]);

        // Create an appointment for the user
        $appointment = UserAppointment::factory()->create([
            'user_id' => $user->id,
            'service_center_id' => $serviceCenter->id,  // Foreign key must reference the created service center
            'services_id' => $service->id,
        ]);

        // Act as the user and delete the appointment
        $response = $this->actingAs($user)->delete("/appointments/{$appointment->id}");

        // Check if the appointment was deleted and redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('message', 'Appointment canceled successfully.');

        // Verify that the appointment was deleted from the database
        $this->assertDatabaseMissing('user_appointments', [
            'id' => $appointment->id,
        ]);
    }

    /**
     * Test unauthorized user cannot delete someone else's appointment.
     */
    public function test_destroy_unauthorized_user_cannot_delete_appointment()
    {
        // Create two users
        $user = User::factory()->create();
        $anotherUser = User::factory()->create();
    
        // Create a service center and a service
        $serviceCenter = ServiceCenter::factory()->create();
        $service = Services::factory()->create([
            'service_center_id' => $serviceCenter->id,  // Link to service center
        ]);
    
        // Create an appointment for the other user
        $appointment = UserAppointment::factory()->create([
            'user_id' => $anotherUser->id,  // This appointment belongs to another user
            'service_center_id' => $serviceCenter->id,  // Valid foreign key
            'services_id' => $service->id,  // Valid foreign key
        ]);
    
        // Act as the first user (who does not own the appointment) and try to delete the appointment
        $response = $this->actingAs($user)->delete("/appointments/{$appointment->id}");
    
        // Check if the user was not authorized to delete the appointment
        $response->assertRedirect();
        $response->assertSessionHas('error', 'You are not authorized to cancel this appointment.');
    
        // Verify that the appointment still exists in the database
        $this->assertDatabaseHas('user_appointments', [
            'id' => $appointment->id,
        ]);
    }    
}


