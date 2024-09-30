<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_a_user()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'dob' => '1990-01-01',
            'password' => bcrypt('password'),
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertEquals('1234567890', $user->phone);
        $this->assertEquals('123 Main St', $user->address);
        $this->assertEquals('1990-01-01', $user->dob);
    }

    public function test_it_has_many_orders()
    {
        $user = User::factory()->create();
        $order1 = Order::factory()->create(['user_id' => $user->id]);
        $order2 = Order::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->orders->contains($order1));
        $this->assertTrue($user->orders->contains($order2));
        $this->assertEquals(2, $user->orders->count());
    }

    public function test_it_casts_attributes()
    {
        $user = User::factory()->create([
            'email_verified_at' => '2023-01-01 00:00:00',
            'password' => bcrypt('password'),
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $user->email_verified_at);
        $this->assertTrue(\Hash::check('password', $user->password));
    }
}