<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAppointment;
use App\Models\User;
use Mockery;

class AppointmentControllerTest extends TestCase
{
    public function test_store_appointment_with_manual_user_id()
    {
       // Create a user using the factory
       $user = User::factory()->create();

       // Prepare the request data with the manually added user_id
       $data = [
           'user_id' => $user->id,  // Manually set the user_id
           'full_name' => 'John Doe',
           'service_center_id' => 1,
           'services_id' => 2,
           'location' => 'Some Location',
           'schedule_date' => '2024-12-31',
           'schedule_time' => '12:00',
        ];

       // Call the controller method or API and pass the data
       $response = $this->post('/api/appointments', $data);

       // Assert that the response status is 200 (success)
       $response->assertStatus(302);
    } 
}

