<?php

namespace Tests\Feature\Admin\Delivery;

use App\Models\Product\Delivery\Delivery;
use Tests\TestCase;

class PutTest extends TestCase
{
    private Delivery $delivery;

    private array $data = [
        'free' => true,
        'fitting' => true,
        'return' => 20
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->delivery = Delivery::create([
            'free' => false,
            'fitting' => false,
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

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
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

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->user, $this->data, [], 403);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
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

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_put(route('admin.deliveries.update', $this->delivery), null, $this->data, [], 401);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['free']);

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_5()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['fitting']);

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_6()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['return']);

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_7()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['free'] = 'qwerty';

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_8()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['fitting'] = 'qwerty';

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_9()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['return'] = 'qwerty';

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_10()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['free'] = 123456;

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_11()
    {
        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['fitting'] = 123456;

        $this->http_put(route('admin.deliveries.update', $this->delivery), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->delivery->free,
            'fitting' => $this->delivery->fitting,
            'return' => $this->delivery->return
        ]);

        $this->assertDatabaseMissing('delivery', [
            'id' => $this->delivery->id,
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }
}
