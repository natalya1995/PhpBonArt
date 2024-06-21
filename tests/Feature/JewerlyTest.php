<?php

namespace Tests\Feature;
use App\Models\Jewerly;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JewerlyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
        /** @test */
    public function it_can_create_a_jewerly()
    {
     $jewerlyData = Jewerly::factory()->raw();
    
     $response = $this->post('/api/jewerlies', $jewerlyData);
 
     $response->assertStatus(201);
     $this->assertDatabaseHas('jewerlies', $jewerlyData);
    }
    
     /** @test */
    public function test_it_can_display_a_jewerly()
    {
        $jewerly = Jewerly::factory()->create();
 
        $response = $this->get('/api/jewerlies/' . $jewerly->id);
 
        $response->assertStatus(200)
                 ->assertJson([
            'title' =>  $jewerly->title,
            'img' =>  $jewerly->img, 
            'description' =>  $jewerly->description,
            'estimate' =>  $jewerly->estimate,
            'location_id' => $jewerly->location_id,
                 ]);
    }
     /** @test */
    public function it_can_update_a_jewerly()
    {
        $jewerly = Jewerly::factory()->create();
 
        $updateData = [
            'title' => 'dfbdfgssdfg',
            'img' =>  'https://miro.medium.com/v2/resize:fit:880/1*rN_in0nFPvGGfXJTDd9AAA.png', 
            'description' => 'dsgerdsfgsergsg',
            'estimate' => 1565,
            'location_id' => null,
        ];
 
 
        $response = $this->put('/api/jewerlies/' . $jewerly->id, $updateData);
 
        $response->assertStatus(200);
        $this->assertDatabaseHas('jewerlies', array_merge(['id' => $jewerly->id], $updateData));
    }
 
 /** @test */
  public function test_it_can_delete_a_jewerly()
    {
        $jewerly = Jewerly::factory()->create();
 
        $response = $this->delete('/api/jewerlies/' . $jewerly->id);
 
        $response->assertStatus(200);
        $this->assertDatabaseMissing('jewerlies', ['id' => $jewerly->id]);
    }
}
