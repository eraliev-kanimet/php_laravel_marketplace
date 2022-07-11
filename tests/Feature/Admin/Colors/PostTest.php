<?php

namespace Tests\Feature\Admin\Colors;

use App\Models\Product\Color\Color;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PostTest extends TestCase
{
    public array $data = [
        'id' => 1,
        'name' => 'white',
        'color' => '#FFFFFF'
    ];

    public function test_1()
    {
        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.store')]);

        $response = $this->postJson(route('admin.colors.store'), $this->data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        $response = $this->postJson(route('admin.colors.store'), $this->data);

        $response->assertStatus(401);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->user, [route('admin.colors.store')]);

        $response = $this->postJson(route('admin.colors.store'), $this->data);

        $response->assertStatus(403);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.store')]);

        $data = $this->data;
        unset($data['name']);
        $response = $this->postJson(route('admin.colors.store'), $data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_5()
    {
        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.store')]);

        $data = $this->data;
        unset($data['color']);
        $response = $this->postJson(route('admin.colors.store'), $data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_6()
    {
        $color = Color::create([
            'name' => 'white',
            'color' => '#FFFFF0'
        ]);
        $this->data['id'] = 2;

        $this->assertDatabaseHas('colors', [
            'id' => $color->id,
            'name' => $color->name,
            'color' => $color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.store')]);

        $response = $this->postJson(route('admin.colors.store'), $this->data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }

    public function test_7()
    {
        $color = Color::create([
            'name' => 'black',
            'color' => '#FFFFFF'
        ]);
        $this->data['id'] = 2;

        $this->assertDatabaseHas('colors', [
            'id' => $color->id,
            'name' => $color->name,
            'color' => $color->color
        ]);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.store')]);

        $response = $this->postJson(route('admin.colors.store'), $this->data);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'color' => $this->data['color']
        ]);
    }
}
