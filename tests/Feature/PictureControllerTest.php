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
}
