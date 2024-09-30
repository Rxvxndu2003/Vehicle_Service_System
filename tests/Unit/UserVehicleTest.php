<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\UserVehicle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserVehicleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_user_vehicle()
    {
        $user = User::factory()->create();
    
        $userVehicle = UserVehicle::create([
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'vehicle_name' => 'Toyota Camry',
            'vehicle_number' => 'ABC123',
            'made' => '2020-01-01', // Provide a valid date format
        ]);
    
        $this->assertInstanceOf(UserVehicle::class, $userVehicle);
        $this->assertEquals($user->id, $userVehicle->user_id);
        $this->assertEquals('John Doe', $userVehicle->full_name);
        $this->assertEquals('Toyota Camry', $userVehicle->vehicle_name);
        $this->assertEquals('ABC123', $userVehicle->vehicle_number);
        $this->assertEquals('2020-01-01', $userVehicle->made); // Update the assertion
    }

    public function test_it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $userVehicle = UserVehicle::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $userVehicle->user);
        $this->assertEquals($user->id, $userVehicle->user->id);
    }
}