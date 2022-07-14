<?php

namespace Tests\Feature\Admin\Delivery;

use App\Models\Product\Delivery\Delivery;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    private Delivery $delivery;

    protected function setUp(): void
    {
        parent::setUp();

        $this->delivery = Delivery::create([
            'free' => true,
            'fitting' => true,
            'return' => 10
        ]);
    }

    public function test_1()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->http_delete(route('admin.deliveries.destroy', $this->delivery->id), $this->admin);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->http_delete(route('admin.deliveries.destroy', $this->delivery->id), $this->user, 403);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->http_delete(route('admin.deliveries.destroy', $this->delivery->id), null, 401);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseMissing('delivery', [
            'id' => 12345
        ]);

        $this->http_delete(route('admin.deliveries.destroy', 12345), $this->admin, 404);
    }
}
