<?php

namespace Tests\Feature\Admin\Delivery;

use App\Models\Product\Delivery\Delivery;
use Tests\TestCase;

class GetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        for($i = 0; $i < 5; $i++)
        {
            Delivery::create([
                'free' => rand(1, 3) == 1,
                'fitting' => rand(1, 3) == 1,
                'return' => rand(10, 20)
            ]);
        }
    }

    public function test_1()
    {
        $this->assertDatabaseCount('delivery', 5);

        $response = $this->http_get(route('admin.deliveries.index'), $this->admin);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'free',
                    'fitting',
                    'return'
                ]
            ]
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseCount('delivery', 5);

        $this->http_get(route('admin.deliveries.index'), null, [], 401);
    }
}
