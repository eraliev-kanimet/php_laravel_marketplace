<?php

namespace Tests\Feature\Admin\Manufacturer;

use App\Models\Manufacturer\Manufacturer;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class PostTest extends TestCase
{
    protected Manufacturer $manufacturer;

    private array $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manufacturer = Manufacturer::create([
            'name' => 'Manufacturer 1',
            'image' => 'Image path'
        ]);

        $this->data = [
            'name' => 'Manufacturer 2',
            'image' => UploadedFile::fake()->image('image.jpg', 600, 600),
        ];
    }

    public function test_1()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $this->data, [], 201);

        $this->assertDatabaseHas('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        unset($this->data['image']);

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $this->data, [], 201);

        $this->assertDatabaseHas('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $data = $this->data;
        unset($data['name']);

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $data, [], 422);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_4()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->data['name'] = 123456;

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_5()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $data['name'] = $this->manufacturer->name;

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $data, [], 422);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_6()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_post(route('admin.manufacturers.store'), $this->user, $this->data, [], 403);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_7()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->http_post(route('admin.manufacturers.store'), null, $this->data, [], 401);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }

    public function test_8()
    {
        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);

        $this->data['image'] = 'Image path';

        $this->http_post(route('admin.manufacturers.store'), $this->admin, $this->data, [], 422);

        $this->assertDatabaseMissing('manufacturers', [
            'name' => $this->data['name']
        ]);
    }
}
