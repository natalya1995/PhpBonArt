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
            'name' => 'NATA',
            'email' => 'nata1.mark1400@gmail.com',
            'password' => '12345678AA',
            'password_confirmation' => '12345678AA',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'nata1.mark1400@gmail.com',
        ]);
    }

    /** @test */
    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $loginData = [
            'email' => 'nata1.mark1400@gmail.com',
            'password' => '12345678AA',
        ];

        $response = $this->post('/api/login', $loginData);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Login successful',
        ]);
    }

}
