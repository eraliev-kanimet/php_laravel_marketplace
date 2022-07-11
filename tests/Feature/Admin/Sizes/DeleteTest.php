<?php

namespace Tests\Feature\Admin\Sizes;

use App\Models\Product\Size\Size;
use Laravel\Passport\Passport;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    public Size $size;

    protected function setUp(): void
    {
        parent::setUp();

        $this->size = Size::create([
            'name' => 'S',
            'description' => [
                ['Real size', 46]
            ]
        ]);
    }

    public function test_successful_deletion_of_an_entry_in_the_sizes_table()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);

        Passport::actingAs($this->admin, [route('admin.sizes.destroy', $this->size)]);
        $response = $this->deleteJson(route('admin.sizes.destroy', $this->size));
        $response->assertStatus(204);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);
    }

    public function test_deletion_an_entry_in_the_sizes_table_returns_an_error_entry_does_not_exists()
    {
        Passport::actingAs($this->admin, [route('admin.sizes.destroy', 1234)]);
        $response = $this->deleteJson(route('admin.sizes.destroy', 1234));
        $response->assertStatus(404);
    }

    public function test_deletion_an_entry_in_the_sizes_table_returns_an_unauthorized_error()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);

        $response = $this->deleteJson(route('admin.sizes.destroy', $this->size));
        $response->assertStatus(401);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);
    }

    public function test_deletion_an_entry_in_the_sizes_table_returns_an_error_not_enough_rights()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);

        Passport::actingAs($this->user, [route('admin.sizes.destroy', $this->size)]);
        $response = $this->deleteJson(route('admin.sizes.destroy', $this->size));
        $response->assertStatus(403);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description, true)
        ]);
    }
}
