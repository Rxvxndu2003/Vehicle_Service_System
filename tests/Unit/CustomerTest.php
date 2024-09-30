<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Vehicle;
use App\Models\Appointments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_customer()
    {
        $customer = Customer::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'dob' => '1990-01-01',
            'gender' => 'Male',
            'email' => 'john.doe@example.com',
            'phone' => '1234567890',
            'address' => '123 Main Street',
            'city' => 'New York',
        ]);

        $this->assertDatabaseHas('customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
        ]);
    }

    public function test_a_customer_can_have_many_vehicles()
    {
        $customer = Customer::factory()->create();
        $vehicle1 = Vehicle::factory()->create(['customer_id' => $customer->id]);
        $vehicle2 = Vehicle::factory()->create(['customer_id' => $customer->id]);
        $this->assertInstanceOf(Vehicle::class, $customer->vehicle->first());
        $this->assertEquals(2, $customer->vehicle->count());
    }

    public function test_a_customer_can_have_many_appointments()
    {
        $customer = Customer::factory()->create();

        $appointment1 = Appointments::factory()->create(['customer_id' => $customer->id]);
        $appointment2 = Appointments::factory()->create(['customer_id' => $customer->id]);

        $this->assertInstanceOf(Appointments::class, $customer->appointments->first());
        $this->assertEquals(2, $customer->appointments->count());
    }

    public function test_it_deletes_related_vehicles_when_customer_is_deleted()
    {
        $customer = Customer::factory()->create();
        $vehicle = Vehicle::factory()->create(['customer_id' => $customer->id]);

        $customer->delete();

        $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);
    }

    public function test_it_deletes_related_appointments_when_customer_is_deleted()
    {
        $customer = Customer::factory()->create();
        $appointment = Appointments::factory()->create(['customer_id' => $customer->id]);

        $customer->delete();

        $this->assertDatabaseMissing('appointments', ['id' => $appointment->id]);
    }
}
