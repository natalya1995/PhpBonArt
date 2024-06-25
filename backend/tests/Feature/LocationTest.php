<?php

namespace Tests\Feature;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   /** @test */
   public function it_can_create_a_location()
   {
    $locatonData = Location::factory()->raw();
   
    $response = $this->post('/api/locations', $locatonData);

    $response->assertStatus(201);
    $this->assertDatabaseHas('locations', $locatonData);
   }
   
    /** @test */
   public function test_it_can_display_a_location()
   {
       $location = Location::factory()->create();

       $response = $this->get('/api/locations/' . $location->id);

       $response->assertStatus(200)
                ->assertJson([
                    'id' => $location->id,
                    'picture_id' => $location->picture_id,
                ]);
   }
    /** @test */
   public function it_can_update_a_location()
   {
       $location = Location::factory()->create();

       $updateData = [
           'name' => 'Updated Name',
           'picture_id' => null,
       ];


       $response = $this->put('/api/locations/' . $location->id, $updateData);

       $response->assertStatus(200);
       $this->assertDatabaseHas('locations', array_merge(['id' => $location->id], $updateData));
   }

/** @test */
 public function test_it_can_delete_a_location()
   {
       $location = Location::factory()->create();

       $response = $this->delete('/api/locations/' . $location->id);

       $response->assertStatus(200);
       $this->assertDatabaseMissing('locations', ['id' => $location->id]);
   }
}
