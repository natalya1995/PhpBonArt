<?php

namespace Tests\Feature;
use App\Models\Janre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JanreTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   /** @test */
   public function it_can_create_a_janre()
   {
    $janreData = Janre::factory()->raw();
   
    $response = $this->post('/api/janres', $janreData);

    $response->assertStatus(201);
    $this->assertDatabaseHas('janres', $janreData);
   }
   
    /** @test */
   public function test_it_can_display_a_janre()
   {
       $janre = Janre::factory()->create();

       $response = $this->get('/api/janres/' . $janre->id);

       $response->assertStatus(200)
                ->assertJson([
                    'id' => $janre->id,
                    'picture_id' => $janre->picture_id,
                ]);
   }
    /** @test */
   public function it_can_update_a_janre()
   {
       $janre = Janre::factory()->create();

       $updateData = [
           'name' => 'Updated Name',
           'picture_id' => null,
       ];


       $response = $this->put('/api/janres/' . $janre->id, $updateData);

       $response->assertStatus(200);
       $this->assertDatabaseHas('janres', array_merge(['id' => $janre->id], $updateData));
   }

/** @test */
 public function test_it_can_delete_a_janre()
   {
       $janre = Janre::factory()->create();

       $response = $this->delete('/api/janres/' . $janre->id);

       $response->assertStatus(200);
       $this->assertDatabaseMissing('janres', ['id' => $janre->id]);
   }
}
