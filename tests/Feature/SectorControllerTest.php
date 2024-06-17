<?php

// tests/Feature/SectorControllerTest.php

use App\Models\Creator;
use App\Models\Sector;
use App\Models\Picture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectorControllerTest extends TestCase
{
    // use RefreshDatabase;

    // /** @test */
    // public function it_can_list_sectors()
    // {
    //     Sector::factory()->count(3)->create();

    //     $response = $this->get('/sectors');

    //     $response->assertStatus(200);
    //     $response->assertJsonCount(3);
    // }

    // /** @test */
    // public function it_can_create_a_sector()
    // {
    //     $creator = Creator::factory()->create();

    //     $data = [
    //         'img' => 'https://via.placeholder.com/640x480.png',
    //         'title' => 'Sample Picture',
    //         'creator_id' => $creator->id,
    //         'size' => 'large',
    //         'description' => 'Sample Description',
    //         'janre_id' => 1,
    //         'location_id' => 1,
    //         'sector_id' => 1,
    //         'comittent_id' => 1,
    //         'estimate' => 5000,
    //     ];

    //     $response = $this->post('/sectors', $data);

    //     $response->assertStatus(201);
    //     $this->assertDatabaseHas('pictures', $data);
    // }

    // /** @test */
    // public function it_can_show_a_sector()
    // {
    //     $sector = Sector::factory()->create();

    //     $response = $this->get("/sectors/{$sector->id}");

    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'id' => $sector->id,
    //         'name' => $sector->name,
            
    //     ]);
    // }

    // /** @test */
    // public function it_can_update_a_sector()
    // {
    //     $creator = Creator::factory()->create();
    //     $sector = Sector::factory()->create();

    //     $data = [
    //         'img' => 'https://via.placeholder.com/640x480.png/007733?text=consequatur',
    //         'title' => 'Dolores laboriosam voluptas ullam quos.',
    //         'creator_id' => $creator->id,
    //         'size' => 'large',
    //         'description' => 'Ipsam a et at. Deleniti aspernatur quas dolorum eos vel consequuntur.',
    //         'janre_id' => 9,
    //         'location_id' => 2,
    //         'sector_id' => $sector->id,
    //         'comittent_id' => 24,
    //         'estimate' => 6262.02,
    //     ];

    //     $response = $this->put("/sectors/{$sector->id}", $data);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('pictures', $data);
    // }

    // /** @test */
    // public function it_can_delete_a_sector()
    // {
    //     $creator = Creator::factory()->create();
    //     $sector = Sector::factory()->create();
    //     $picture = Picture::factory()->create([
    //         'creator_id' => $creator->id,
    //         'sector_id' => $sector->id
    //     ]);

    //     $response = $this->delete("/sectors/{$sector->id}");

    //     $response->assertStatus(200);
    //     $this->assertDeleted($picture);
    // }
}
