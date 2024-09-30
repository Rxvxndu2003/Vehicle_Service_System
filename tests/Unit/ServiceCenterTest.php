<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ServiceCenter;
use App\Models\Appointments;
use App\Models\Services;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceCenterTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_service_center()
    {
        $serviceCenter = ServiceCenter::create([
            'service_center' => 'Main Service Center',
            'location' => '123 Main St',
        ]);

        $this->assertInstanceOf(ServiceCenter::class, $serviceCenter);
        $this->assertEquals('Main Service Center', $serviceCenter->service_center);
        $this->assertEquals('123 Main St', $serviceCenter->location);
    }

    public function test_it_has_many_appointments()
    {
        $serviceCenter = ServiceCenter::factory()->create();
        $appointment1 = Appointments::factory()->create(['service_center_id' => $serviceCenter->id]);
        $appointment2 = Appointments::factory()->create(['service_center_id' => $serviceCenter->id]);

        $this->assertTrue($serviceCenter->appointments->contains($appointment1));
        $this->assertTrue($serviceCenter->appointments->contains($appointment2));
        $this->assertEquals(2, $serviceCenter->appointments->count());
    }

    public function test_it_has_many_services()
    {
        $serviceCenter = ServiceCenter::factory()->create();
        $service1 = Services::factory()->create(['service_center_id' => $serviceCenter->id]);
        $service2 = Services::factory()->create(['service_center_id' => $serviceCenter->id]);

        $this->assertTrue($serviceCenter->services->contains($service1));
        $this->assertTrue($serviceCenter->services->contains($service2));
        $this->assertEquals(2, $serviceCenter->services->count());
    }
}