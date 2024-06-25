<?php
namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_it_can_create_a_user()
    {
        $userData = User::factory()->raw(['password' => 'password']);

        $response = $this->post('/api/users', $userData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
        ]);
    }

    /** @test */
    public function test_it_can_update_a_user()
    {
        $user = User::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            // Add any other necessary fields
        ];

        $response = $this->put("/api/users/{$user->id}", $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', array_merge(['id' => $user->id], $updateData));
    }

    /** @test */
    public function test_it_can_get_a_user()
    {
        $user = User::factory()->create();

        $response = $this->get("/api/users/{$user->id}");
        $response->assertStatus(200)->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'bit_id' => $user->bit_id,
        ]);
    }
     /** @test */
     public function test_it_can_delete_a_user()
     {
         $user = User::factory()->create();
 
         $response = $this->delete("/api/users/{$user->id}");
 
         $response->assertStatus(200);
         $this->assertDatabaseMissing('users', ['id' => $user->id]);
     }
}
