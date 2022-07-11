<?php

namespace Tests\Feature\Admin\Sizes;

use App\Models\Product\Size\Size;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        for($i = 1; $i < 5; $i++) {
             Size::create([
                'name' => 'Color ' . $i,
                 'description' => [
                     ['Real size', $i + $i + 40]
                 ]
            ]);
        }
    }

    public function test_successful_receipt_of_all_sizes()
    {
        Passport::actingAs($this->user, [route('admin.sizes.index')]);
        $response = $this->getJson(route('admin.sizes.index'));
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'description'
                ]
            ]
        ]);
    }

    public function test_getting_all_sizes_returns_error_not_authorized()
    {
        $response = $this->getJson(route('admin.sizes.index'));
        $response->assertStatus(401);
    }
}
