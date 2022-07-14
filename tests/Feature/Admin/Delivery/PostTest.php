<?php

namespace Tests\Feature\Admin\Delivery;

use Tests\TestCase;

class PostTest extends TestCase
{
    private array $data = [
        'free' => true,
        'fitting' => true,
        'return' => 10
    ];

    public function test_1()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 201);

        $this->assertDatabaseHas('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['free']);

        $this->http_post(route('admin.deliveries.store'), $this->admin, $data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['fitting']);

        $this->http_post(route('admin.deliveries.store'), $this->admin, $data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $data = $this->data;
        unset($data['return']);

        $this->http_post(route('admin.deliveries.store'), $this->admin, $data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_5()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['free'] = 'qwerty';

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_6()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['fitting'] = 'qwerty';

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_7()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['return'] = 'qwerty';

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_8()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['free'] = 123456;

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_9()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->data['fitting'] = 123456;

        $this->http_post(route('admin.deliveries.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_10()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_post(route('admin.deliveries.store'), $this->user, $this->data, [], 403);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }

    public function test_11()
    {
        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);

        $this->http_post(route('admin.deliveries.store'), null, $this->data, [], 401);

        $this->assertDatabaseMissing('delivery', [
            'free' => $this->data['free'],
            'fitting' => $this->data['fitting'],
            'return' => $this->data['return']
        ]);
    }
}
