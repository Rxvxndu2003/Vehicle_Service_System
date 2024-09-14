<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mockery;

class UserControllerTest extends TestCase
{
    public function test_create_user_validation_error()
    {
        // Mock request data with missing required fields
        $request = Request::create('/api/create-user', 'POST', [
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        // Call the createUser method in UserController
        $controller = new \App\Http\Controllers\Api\UserController();
        $response = $controller->createUser($request);

        // Assert that validation error occurred
        $this->assertEquals(401, $response->status());
        $this->assertArrayHasKey('errors', $response->getData(true));
    }

    public function test_create_user_success()
    {
        // Create a fake request with user data
        $request = Request::create('/api/create-user', 'POST', [
            'name' => 'Nimal Bandara',
            'email' => 'nimal@example.com',
            'phone' => '0765678987',
            'address' => '123 Main St',
            'dob' => '1990-01-05',
            'password' => 'password1234'
        ]);
    
        // Call the createUser method in UserController
        $controller = new \App\Http\Controllers\Api\UserController();
    
        // Mock the User::create() method
        $user = User::factory()->make([
            'name' => 'Nimal Bandara',
            'email' => 'nimal@example.com',
            'phone' => '0765678987',
            'address' => '123 Main St',
            'dob' => '1990-01-05',
            'password' => bcrypt('password1234')
        ]);
    
        // Instead of mocking createToken, allow User factory and pass token normally
        $response = $controller->createUser($request);
    
        // Assert that the user is created and token is returned
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('token', $response->getData(true));
        $this->assertEquals('User Created Successfully', $response->getData(true)['message']);
    }
    

    public function test_login_user_validation_error()
{
    // Mock request data with missing required fields
    $request = Request::create('/api/login-user', 'POST', [
        'email' => '',
        'password' => '',
    ]);

    // Call the loginUser method in UserController
    $controller = new \App\Http\Controllers\Api\UserController();
    $response = $controller->loginUser($request);

    // Assert that validation error occurred
    $this->assertEquals(401, $response->status());
    $this->assertArrayHasKey('errors', $response->getData(true));
}
public function test_login_user_invalid_credentials()
{
    // Mock request data with invalid credentials
    $request = Request::create('/api/login-user', 'POST', [
        'email' => 'wrong@example.com',
        'password' => 'wrongpassword',
    ]);

    // Mock Auth::attempt to return false (invalid credentials)
    \Illuminate\Support\Facades\Auth::shouldReceive('attempt')->andReturn(false);

    // Call the loginUser method in UserController
    $controller = new \App\Http\Controllers\Api\UserController();
    $response = $controller->loginUser($request);

    // Assert that the login failed
    $this->assertEquals(401, $response->status());
    $this->assertEquals('Email & Password does not match with our record.', $response->getData(true)['message']);
}
public function test_login_user_success()
{
    // Mock the Auth attempt to simulate successful authentication
    \Illuminate\Support\Facades\Auth::shouldReceive('attempt')
        ->once()
        ->andReturn(true);

    // Create a mock user with a factory
    $user = User::factory()->make([
        'email' => 'test@example.com',
        'password' => bcrypt('password123')  // Ensure the password is hashed
    ]);

    // Mock the token creation for the user
    $userMock = Mockery::mock($user);
    $userMock->shouldReceive('createToken')->andReturn((object) ['plainTextToken' => 'fake-token']);

    // Simulate finding the user by email
    \Illuminate\Support\Facades\DB::shouldReceive('table')
        ->with('users')
        ->andReturnSelf()
        ->shouldReceive('where')
        ->with('email', 'test@example.com')
        ->andReturnSelf()
        ->shouldReceive('first')
        ->andReturn($userMock);

    // Create a fake request with valid credentials
    $request = Request::create('/api/login-user', 'POST', [
        'email' => 'test@example.com',
        'password' => 'password123'
    ]);

    // Call the loginUser method in UserController
    $controller = new \App\Http\Controllers\Api\UserController();
    $response = $controller->loginUser($request);

    // Assert the login is successful and token is returned
    $this->assertEquals(200, $response->status());
    $this->assertArrayHasKey('token', $response->getData(true));
    $this->assertEquals('User Logged In Successfully', $response->getData(true)['message']);
}

}
