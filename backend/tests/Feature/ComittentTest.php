<?php

namespace Tests\Feature;

use App\Models\Comittent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ComittentTest extends TestCase
{
    /**
     * A basic feature test example.
     */

  
 
     /** @test */
     public function test_it_can_display_a_comittent()
     {
         $comittent = Comittent::factory()->create();
 
         $response = $this->get('/api/comittents/' . $comittent->id);
 
         $response->assertStatus(200)
                  ->assertJson([
                   'name' =>$comittent->name,
                   'IIN' => $comittent->IIN,
                   'num_udv' => $comittent->num_udv,
                   'picture_id' => $comittent->picture_id, 
                   'entry_price' => $comittent->entry_price,
                  ]);
     }

      /** @test */
     public function it_can_update_a_comittent()
     {
         $comittent = Comittent::factory()->create();
 
         $updateData = [
                   'name' =>'gregtg',
                   'IIN' => '2222222',
                   'num_udv' =>'2222222',
                   'picture_id' => null, 
                   'entry_price' => '123456',
         ];
         $response = $this->put('/api/comittents/' . $comittent->id, $updateData);
         $response->assertStatus(200);
         $this->assertDatabaseHas('comittents', array_merge(['id' => $comittent->id], $updateData));
     }

  /** @test */
   public function test_it_can_delete_a_comittent()
     {
         $comittent = Comittent::factory()->create();
 
         $response = $this->delete('/api/comittents/' . $comittent->id);
 
         $response->assertStatus(200);
         $this->assertDatabaseMissing('comittents', ['id' => $comittent->id]);
     }
}
