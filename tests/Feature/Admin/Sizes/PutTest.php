<?php

namespace Tests\Feature\Admin\Sizes;

use App\Models\Product\Size\Size;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PutTest extends TestCase
{
    public Size $size;
    public array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->size = Size::create([
            'name' => 'S',
            'description' => [['Real size', 48]]
        ]);

        $this->data = [
            'name' => 'M',
            'description' => [['Real size', 45]]
        ];
    }

    public function test_successful_update_of_an_entry_in_the_sizes_table()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        Passport::actingAs($this->admin, [route('admin.sizes.update', $this->size->id)]);
        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $this->data);
        $response->assertStatus(200);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_updating_an_entry_in_the_size_table_returns_an_error_not_authorized()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $this->data);
        $response->assertStatus(401);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_updating_an_entry_in_the_size_table_it_returns_an_error_not_enough_rights()
    {
        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        Passport::actingAs($this->user, [route('admin.sizes.update', $this->size->id)]);
        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $this->data);
        $response->assertStatus(403);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_updating_an_entry_in_the_size_table_it_returns_an_error_that_the_entry_does_not_exist()
    {
        Passport::actingAs($this->admin, [route('admin.sizes.update', 12345)]);
        $response = $this->putJson(route('admin.sizes.update', 12345), $this->data);
        $response->assertStatus(404);
    }

    public function test_when_updating_an_entry_in_the_size_table_it_returns_an_error_already_exists()
    {
        Size::create([
            'name' => 'M',
            'description' => [['Real size', 45]]
        ]);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        Passport::actingAs($this->admin, [route('admin.sizes.update', $this->size->id)]);
        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $this->data);
        $response->assertStatus(422);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->size->id,
            'name' => $this->size->name,
            'description' => json_encode($this->size->description)
        ]);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->size->id,
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_updating_an_entry_in_the_size_table_it_returns_an_error_the_name_of_the_required_field()
    {
        $data = $this->data;
        unset($data['name']);

        Passport::actingAs($this->admin, [route('admin.sizes.update', $this->size->id)]);
        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $data);
        $response->assertStatus(422);
    }

    public function test_when_updating_an_entry_in_the_size_table_it_returns_an_error_the_description_of_the_required_field()
    {
        $data = $this->data;
        unset($data['description']);

        Passport::actingAs($this->admin, [route('admin.sizes.update', $this->size->id)]);
        $response = $this->putJson(route('admin.sizes.update', $this->size->id), $data);
        $response->assertStatus(422);
    }
}
