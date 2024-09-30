<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Services;
use App\Models\ServiceCenter;
use App\Models\Appointments;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServicesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_service()
    {
        $serviceCenter = ServiceCenter::factory()->create();

        $service = Services::create([
            'service_center_id' => $serviceCenter->id,
            'service_name' => 'Oil Change',
            'location' => '123 Main St',
            'description' => 'Complete oil change service',
            'price' => 29.99,
        ]);

        $this->assertInstanceOf(Services::class, $service);
        $this->assertEquals('Oil Change', $service->service_name);
        $this->assertEquals('123 Main St', $service->location);
        $this->assertEquals('Complete oil change service', $service->description);
        $this->assertEquals(29.99, $service->price);
    }

    public function test_it_belongs_to_a_service_center()
    {
        $serviceCenter = ServiceCenter::factory()->create();
        $service = Services::factory()->create(['service_center_id' => $serviceCenter->id]);

        $this->assertInstanceOf(ServiceCenter::class, $service->service_center);
        $this->assertEquals($serviceCenter->id, $service->service_center->id);
    }

    public function test_it_has_many_appointments()
    {
        $service = Services::factory()->create();
        $appointment1 = Appointments::factory()->create(['services_id' => $service->id]);
        $appointment2 = Appointments::factory()->create(['services_id' => $service->id]);

        $this->assertTrue($service->appointments->contains($appointment1));
        $this->assertTrue($service->appointments->contains($appointment2));
        $this->assertEquals(2, $service->appointments->count());
    }
}