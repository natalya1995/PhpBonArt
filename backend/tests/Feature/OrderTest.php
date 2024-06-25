<?php
namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_order()
    {
        $orderData = Order::factory()->raw();

        $response = $this->post('/api/orders', $orderData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('orders', $orderData);
    }

    /** @test */
    public function test_it_can_display_a_order()
    {
        $order = Order::factory()->create();

        $response = $this->get('/api/orders/' . $order->id);

        $response->assertStatus(200)
            ->assertJson([
                'user_id' => $order->user_id,
                'status_order' => $order->status_order,
                'sum' => $order->sum,
            ]);
    }

    /** @test */
    public function it_can_update_a_order()
    {
        $order = Order::factory()->create();

        $updateData = [
            'status_order' => true,
            'sum' => 1000,  // Assuming the sum is updated as well for completeness
        ];

        $response = $this->put('/api/orders/' . $order->id, $updateData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', array_merge(['id' => $order->id], $updateData));
    }

    /** @test */
    public function test_it_can_delete_a_order()
    {
        $order = Order::factory()->create();

        $response = $this->delete('/api/orders/' . $order->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}

