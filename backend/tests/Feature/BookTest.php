<?php

namespace Tests\Feature;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
     /** @test */
     public function it_can_create_a_book()
     {
      $bookData = Book::factory()->raw();
     
      $response = $this->post('/api/books', $bookData);
  
      $response->assertStatus(201);
      $this->assertDatabaseHas('books', $bookData);
     }
     
      /** @test */
     public function test_it_can_display_a_book()
     {
         $book = Book::factory()->create();
  
         $response = $this->get('/api/books/' . $book->id);
  
         $response->assertStatus(200)
                  ->assertJson([
                    'title' =>$book->title,
                    'img' =>$book->img,
                    'creator_id' => $book->creator_id,
                    'description' => $book->description,
                    'num_pages' => $book->num_pages,
                    'num_copy' => $book->num_copy,
                    'estimate' => $book->estimate,
                    'location_id' => $book->location_id,
                  ]);
     }
      /** @test */
     public function it_can_update_a_book()
     {
         $book = Book::factory()->create();
  
         $updateData = [
            'title' => 'Updated Title',
            'img' => 'updated_image_url',
            'creator_id' => \App\Models\Creator::factory()->create()->id,
            'description' => 'Updated Description',
            'num_pages' => 200,
            'num_copy' => 10,
            'estimate' => 5000,
            'location_id' => \App\Models\Location::factory()->create()->id,
         ];
  
  
         $response = $this->put('/api/books/' . $book->id, $updateData);
  
         $response->assertStatus(200);
         $this->assertDatabaseHas('books', array_merge(['id' => $book->id], $updateData));
     }
  
  /** @test */
   public function test_it_can_delete_a_book()
     {
         $book = Book::factory()->create();
  
         $response = $this->delete('/api/books/' . $book->id);
  
         $response->assertStatus(200);
         $this->assertDatabaseMissing('books', ['id' => $book->id]);
     }
}
