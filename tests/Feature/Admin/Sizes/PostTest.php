<?php

namespace Tests\Feature\Admin\Sizes;

use App\Models\Product\Size\Size;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PostTest extends TestCase
{
    public array $data;
    public Size $size;

    protected function setUp(): void
    {
        parent::setUp();

        $this->size = Size::create([
            'name' => 'M',
            'description' => [['Real size', 48]]
        ]);

        $this->data = [
            'id' => 2,
            'name' => 'S',
            'description' => [['Real size', 48]]
        ];
    }

    public function test_successful_creation_of_an_entry_in_the_sizes_table()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
        $data = $this->data;
        unset($data['id']);

        Passport::actingAs($this->admin, [route('admin.sizes.store')]);
        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_creating_an_entry_in_the_size_table_returns_an_error_not_authorized()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
        $data = $this->data;
        unset($data['id']);

        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(401);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_creating_an_entry_in_the_size_table_it_returns_an_error_not_enough_rights()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
        $data = $this->data;
        unset($data['id']);

        Passport::actingAs($this->user, [route('admin.sizes.store')]);
        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(403);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_creating_an_entry_in_the_size_table_it_returns_an_error_already_exists()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        $this->data['name'] = $this->size->name;
        $data = $this->data;
        unset($data['id']);

        Passport::actingAs($this->admin, [route('admin.sizes.store')]);
        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(422);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_creating_an_entry_in_the_size_table_it_returns_an_error_the_name_of_the_required_field()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        $data = $this->data;
        unset($data['id']);
        unset($data['name']);

        Passport::actingAs($this->admin, [route('admin.sizes.store')]);
        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(422);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }

    public function test_when_creating_an_entry_in_the_size_table_it_returns_an_error_the_description_of_the_required_field()
    {
        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);

        $data = $this->data;
        unset($data['id']);
        unset($data['description']);

        Passport::actingAs($this->admin, [route('admin.sizes.store')]);
        $response = $this->postJson(route('admin.sizes.store'), $data);
        $response->assertStatus(422);

        $this->assertDatabaseMissing('sizes', [
            'id' => $this->data['id'],
            'name' => $this->data['name'],
            'description' => json_encode($this->data['description'])
        ]);
    }
}
