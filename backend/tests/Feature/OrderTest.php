<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_order()
    {
        $order = Order::factory()->create();

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'sum' => $order->sum,
        ]);
    }

    /** @test */
    public function it_updates_an_order_status()
    {
        $order = Order::factory()->create([
            'status_order' => false,
        ]);

        $order->update(['status_order' => true]);

        $this->assertTrue($order->status_order);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_order' => true,
        ]);
    }

    /** @test */
    public function it_calculates_order_sum_correctly()
    {
        $order = Order::factory()->create([
            'sum' => 100.00,
        ]);

        $this->assertEquals(100.00, $order->sum);
    }
}
