<?php

namespace Tests\Feature\Admin\Manufacturer;

use App\Models\Manufacturer\Manufacturer;
use Tests\TestCase;

class GetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        for ($i = 1; $i < 6; $i++)
        {
            Manufacturer::create([
                'name' => 'Manufacturer name ' . $i,
                'image' => 'image path'
            ]);
        }
    }

    public function test_1()
    {
        $this->assertDatabaseCount('manufacturers', 5);

        $response = $this->http_get(route('admin.manufacturers.index'), $this->admin);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'image'
                ]
            ]
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseCount('manufacturers', 5);

        $this->http_get(route('admin.manufacturers.index'), null, [], 401);
    }
}
