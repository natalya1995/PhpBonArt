<?php
// tests/Feature/CreatorControllerTest.php

use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreatorControllerTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    // public function it_can_list_creators()
    // {
    //     Creator::factory()->count(3)->create();

    //     $response = $this->get('/creators');

    //     $response->assertStatus(200);
    //     $response->assertJsonCount(3);
    // }

    // /** @test */
     public function it_can_create_a_creator()
     {
         $creatorData = Creator::factory()->raw();

         $response = $this->post('/creators', $creatorData);

        $response->assertStatus(201);
         $this->assertDatabaseHas('creators', $creatorData);
     }

    // /** @test */
    // public function it_can_show_a_creator()
    // {
    //     $creator = Creator::factory()->create();

    //     $response = $this->get("/creators/{$creator->id}");

    //     $response->assertStatus(200);
    //     $response->assertJson([
    //         'id' => $creator->id,
    //         'name' => $creator->name,
          
    //     ]);
    // }

    // /** @test */
    // public function it_can_update_a_creator()
    // {
    //     $creator = Creator::factory()->create();
    //     $creatorData = Creator::factory()->raw();

    //     $response = $this->put("/creators/{$creator->id}", $creatorData);

    //     $response->assertStatus(200);
    //     $this->assertDatabaseHas('creators', $creatorData);
    // }

    // /** @test */
    // public function it_can_delete_a_creator()
    // {
    //     $creator = Creator::factory()->create();

    //     $response = $this->delete("/creators/{$creator->id}");

    //     $response->assertStatus(200);
    //     $this->assertDeleted($creator);
    // }
}
