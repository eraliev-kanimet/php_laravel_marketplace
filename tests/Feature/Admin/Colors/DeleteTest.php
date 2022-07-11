<?php

namespace Tests\Feature\Admin\Colors;

use App\Models\Product\Color\Color;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    public Color $color;

    protected function setUp(): void
    {
        parent::setUp();

        $this->color = Color::create([
            'name' =>'black',
            'color' => '#000000'
        ]);
    }

    public function test_deleting_an_entry_from_the_colors_table_deleted_succesfully()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->admin, [route('admin.colors.destroy', $this->color->id)]);
        $response = $this->deleteJson(route('admin.colors.destroy', $this->color->id));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);
    }

    public function test_deleting_an_entry_from_the_colors_table_returns_an_unauthorized_error()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        $response = $this->deleteJson(route('admin.colors.destroy', $this->color->id));
        $response->assertStatus(401);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);
    }

    public function test_deletion_an_entry_from_the_colors_table_returns_a_not_found_error()
    {
        Passport::actingAs($this->admin, [route('admin.colors.destroy', 12345)]);
        $response = $this->deleteJson(route('admin.colors.destroy', 12345));
        $response->assertStatus(404);
    }

    public function test_delete_one()
    {
        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);

        Passport::actingAs($this->user, [route('admin.colors.destroy', $this->color->id)]);
        $response = $this->deleteJson(route('admin.colors.destroy', $this->color->id));
        $response->assertStatus(403);

        $this->assertDatabaseHas('colors', [
            'id' => $this->color->id,
            'name' => $this->color->name,
            'color' => $this->color->color
        ]);
    }
}
