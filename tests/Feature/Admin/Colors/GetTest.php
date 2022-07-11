<?php

namespace Tests\Feature\Admin\Colors;

use App\Models\Product\Color\Color;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        for ($i = 1; $i < 4; $i++) {
            $this->color = Color::create([
                'name' =>'black' . $i,
                'color' => '#00000' . $i
            ]);
        }
    }

    public function test_getting_all_data_from_colors_table_received_successfully()
    {
        Passport::actingAs($this->user, [route('admin.colors.index')]);

        $response = $this->getJson(route('admin.colors.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'name',
                    'color'
                ]
            ]
        ]);
    }

    public function test_getting_all_data_from_colors_table_error_not_authorized()
    {
        $response = $this->getJson(route('admin.colors.index'));

        $response->assertStatus(401);
    }
}
