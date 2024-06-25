<?php

namespace Tests\Feature;

use App\Models\Sector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SectorControllerTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function it_can_create_a_sector()
    {
        $sectorData = Sector::factory()->raw();

        $response = $this->post('/api/sectors', $sectorData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('sectors', $sectorData);
    }

    /** @test */
    public function it_can_display_a_sector()
    {
        $sector = Sector::factory()->create();

        $response = $this->get('/api/sectors/' . $sector->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'id' => $sector->id,
                     'num' => $sector->num,
                     'picture_id'=>null,
                 ]);
    }

    /** @test */
    public function it_can_update_a_sector()
    {
        $sector = Sector::factory()->create();

        $updateData = [
            'num' => 10,
        ];

        $response = $this->put('/api/sectors/' . $sector->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('sectors', array_merge(['id' => $sector->id], $updateData));
    }

    /** @test */
    public function it_can_delete_a_sector()
    {
        $sector = Sector::factory()->create();

        $response = $this->delete('/api/sectors/' . $sector->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('sectors', ['id' => $sector->id]);
    }
}
