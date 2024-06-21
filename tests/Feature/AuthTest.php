<?php
namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function test_user_can_register()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test2212@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'test2212@example.com',
        ]);
    }

    /** @test */
    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'email' => 'test2212@example.com',
            'password' => Hash::make('password'),
        ]);

        $loginData = [
            'email' => 'test2212@example.com',
            'password' => 'password',
        ];

        $response = $this->post('/api/login', $loginData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Login successful',
        ]);
    }

}
