<?php
namespace Tests\Feature;

use App\Models\Creator;
use App\Models\Janre;
use App\Models\Location;
use App\Models\Sector;
use App\Models\Comittent;
use App\Models\Picture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PictureControllerTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function it_can_create_a_picture()
    {
        $creator = Creator::factory()->create();
        $janre = Janre::factory()->create();
        $location = Location::factory()->create();
        $sector = Sector::factory()->create();
        $comittent = Comittent::factory()->create();

        $pictureData = [
            'img' => 'https://via.placeholder.com/640x480.png/002299?text=mollitia',
            'title' => 'Distinctio minus aut ut sunt.',
            'creator_id' =>null,
            'size' => 'large',
            'description' => 'Incidunt rerum sapiente molestiae vel illum incidunt. A accusantium est eum et incidunt aliquam et. Tempore eaque in deserunt debitis aut hic dolore.',
            'janre_id' => null,
            'location_id' =>null,
            'sector_id' => null,
            'comittent_id' =>null,
            'estimate' => 1582.71,
        ];

        $response = $this->post('/api/pictures', $pictureData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('pictures', $pictureData);
    }
      /** @test */
      public function test_it_can_display_a_picture()
      {
          $picture = Picture::factory()->create();
  
          $response = $this->get('/api/pictures/' . $picture->id);
  
          $response->assertStatus(200)
                   ->assertJson([
                   'img' =>$picture->img ,
                   'title' => $picture->title,
                   'creator_id' =>$picture->creator_id,
                   'size' => $picture->size,
                   'description' => $picture->description,
                   'janre_id' =>$picture->janre_id,
                   'location_id' =>$picture->location_id,
                   'sector_id' => $picture->sector_id,
                   'comittent_id' =>$picture->comittent_id,
                   'estimate' => $picture->estimate,
                   ]);
      }
        
      /** @test */
      public function it_can_update_a_picture()
      {
          $picture = Picture::factory()->create();
          $updateData = [
              'title' => 'Updated Title',
              'description' => 'Updated description',
              'estimate' => 2000.00,
          ];
  
          $response = $this->put('/api/pictures/' . $picture->id, $updateData);
  
          $response->assertStatus(200);
          $this->assertDatabaseHas('pictures', array_merge(['id' => $picture->id], $updateData));
      }
  
      /** @test */
      public function it_can_delete_a_picture()
      {
          $picture = Picture::factory()->create();
  
          $response = $this->delete('/api/pictures/' . $picture->id);
  
          $response->assertStatus(200);
          $this->assertDatabaseMissing('pictures', ['id' => $picture->id]);
      }
}
