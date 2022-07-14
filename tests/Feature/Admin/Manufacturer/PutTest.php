<?php

namespace Tests\Feature\Admin\Manufacturer;

use App\Models\Manufacturer\Manufacturer;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PutTest extends TestCase
{
    protected Manufacturer $manufacturer;

    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manufacturer = Manufacturer::create([
            'name' => 'Manufacturer 1',
            'image' => 'Image path 1'
        ]);

        $this->data = [
            'name' => 'Manufacturer 2',
            'image' => UploadedFile::fake()->image('image.jpg', 600, 600)
        ];
    }

    public function test_1()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $this->data);

        $this->assertDatabaseMissing('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseHas('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        unset($this->data['image']);

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $this->data);

        $this->assertDatabaseMissing('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseHas('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        unset($this->data['image']);
        $this->data['remove_image'] = 'true';

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $this->data);

        $this->assertDatabaseMissing('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => ''
        ]);

        $this->assertDatabaseHas('manufacturers', [
            'name' => $this->data['name'],
            'image' => ''
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $data  = $this->data;
        unset($data['name']);

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $data, [], 422);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_6()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->data['image'] = 'qwerty';

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_7()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $manufacturer = Manufacturer::create([
            'name' => 'Manufacturer 12345',
            'image' => 'Image path 12345'
        ]);

        $data = $this->data;
        $data['name'] = $manufacturer->name;

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $data, [], 422);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_8()
    {
        $this->http_put(route('admin.manufacturers.update', 12345), $this->admin, $this->data, [], 404);
    }

    public function test_9()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->user, $this->data, [], 403);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_10()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), null, $this->data, [], 401);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_11()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->data['name'] = 123456;

        $this->http_put(route('admin.manufacturers.update', $this->manufacturer->id), $this->admin, $this->data, [], 422);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }
}
