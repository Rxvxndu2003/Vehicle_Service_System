<?php
namespace Tests\Unit;
use App\Models\Appointments;
use App\Models\Customer;
use App\Models\ServiceCenter;
use App\Models\Services;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AppointmentsTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_can_create_an_appointment()
    {
        $customer = Customer::factory()->create();
        $serviceCenter = ServiceCenter::factory()->create();
        $service = Services::factory()->create();
        $appointment = Appointments::create([
            'customer_id' => $customer->id,
            'service_center_id' => $serviceCenter->id,
            'services_id' => $service->id,
            'location' => 'Some Location',
            'schedule_date' => now()->toDateString(),
            'schedule_time' => now()->toTimeString(),
            'is_completed' => false,
        ]);
        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'customer_id' => $customer->id,
            'service_center_id' => $serviceCenter->id,
            'services_id' => $service->id,
            'location' => 'Some Location',
            'schedule_date' => now()->toDateString(),
            'schedule_time' => now()->toTimeString(),
            'is_completed' => false,
        ]);
    }
    public function test_it_belongs_to_a_customer()
    {
        $customer = Customer::factory()->create();
        $appointment = Appointments::factory()->create(['customer_id' => $customer->id]);
        $this->assertInstanceOf(Customer::class, $appointment->customer);
        $this->assertEquals($customer->id, $appointment->customer->id);
    }

    public function test_it_belongs_to_a_service_center()
    {
        $serviceCenter = ServiceCenter::factory()->create();
        $appointment = Appointments::factory()->create(['service_center_id' => $serviceCenter->id]);
        $this->assertInstanceOf(ServiceCenter::class, $appointment->service_center);
        $this->assertEquals($serviceCenter->id, $appointment->service_center->id);
    }

    public function test_it_belongs_to_a_service()
    {
        $service = Services::factory()->create();
        $appointment = Appointments::factory()->create(['services_id' => $service->id]);
        $this->assertInstanceOf(Services::class, $appointment->services);
        $this->assertEquals($service->id, $appointment->services->id);
    }
}
