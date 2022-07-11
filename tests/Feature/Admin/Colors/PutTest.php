<?php

namespace Tests\Feature\Admin\Colors;

use App\Models\Product\Color\Color;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PutTest extends TestCase
{
    public Color $color;
    public Color $color_second;

    public array $data = [
        'name' => 'black',
        'color' => '#000000'
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->color = Color::create([
            'name' => 'white',
            'color' => '#FFFFFF'
        ]);

        $this->color_second = Color::create([
            'name' => 'green',
            'color' => '#FEFEFE'
        ]);
    }

    public function test_1()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.update', $this->color->id)]);

        $response = $this->putJson(route('admin.colors.update', $this->color->id), $this->data);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $response = $this->putJson(route('admin.colors.update', $this->color->id), $this->data);

        $response->assertStatus(401);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->user, [route('admin.colors.update', $this->color->id)]);

        $response = $this->putJson(route('admin.colors.update', $this->color->id), $this->data);

        $response->assertStatus(403);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_4()
    {
        Passport::actingAs($this->admin, [route('admin.colors.update', 12345)]);

        $response = $this->putJson(route('admin.colors.update', 12345), $this->data);

        $response->assertStatus(404);
    }

    public function test_5()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.update', $this->color->id)]);

        $data = $this->data;
        unset($data['name']);
        $response = $this->putJson(route('admin.colors.update', $this->color->id), $data);

        $response->assertStatus(422);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_6()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.update', $this->color->id)]);

        $data = $this->data;
        unset($data['color']);
        $response = $this->putJson(route('admin.colors.update', $this->color->id), $data);

        $response->assertStatus(422);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_7()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color_second->id,
            'name' => $this->color_second->name,
            'color' => $this->color_second->color
        ]);

        $this->data['name'] = $this->color_second->name;

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.update', $this->color->id)]);

        $response = $this->putJson(route('admin.colors.update', $this->color->id), $this->data);

        $response->assertStatus(422);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_8()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color_second->id,
            'name' => $this->color_second->name,
            'color' => $this->color_second->color
        ]);

        $this->data['color'] = $this->color_second->color;

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.update', $this->color->id)]);

        $response = $this->putJson(route('admin.colors.update', $this->color->id), $this->data);

        $response->assertStatus(422);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }
}
