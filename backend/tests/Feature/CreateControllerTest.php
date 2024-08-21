<?php
// tests/Feature/CreatorControllerTest.php

namespace Tests\Feature;

use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateControllerTest extends TestCase
{
   // use RefreshDatabase;

    /** @test */
    public function test_it_can_create_a_creator()
    {
        $creatorData = Creator::factory()->raw();
   
        $response = $this->post('/api/creators', $creatorData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('creators', $creatorData);
    }


     /** @test */
    public function it_can_update_a_creator()
    {
        $creator = Creator::factory()->create();

        $updateData = [
            'name' => 'Updated Name',
            'YY' => '2000-2020',
            'biography' => 'Updated biography',
            'picture_id' => null,
        ];


        $response = $this->put('/api/creators/' . $creator->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('creators', array_merge(['id' => $creator->id], $updateData));
    }
 /** @test */
  public function test_it_can_delete_a_creator()
    {
        $creator = Creator::factory()->create();

        $response = $this->delete('/api/creators/' . $creator->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('creators', ['id' => $creator->id]);
    }
}
