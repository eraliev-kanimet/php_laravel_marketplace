<?php

namespace Tests\Feature\Admin\Manufacturer;

use App\Models\Manufacturer\Manufacturer;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    protected Manufacturer $manufacturer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manufacturer = Manufacturer::create([
            'name' => 'Manufacturer name',
            'image' => 'Image path'
        ]);
    }

    public function test_1()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->http_delete(route('admin.manufacturers.destroy', $this->manufacturer->id), $this->admin);

        $this->assertDatabaseMissing('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);
    }

    public function test_2()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->http_delete(route('admin.manufacturers.destroy', $this->manufacturer->id), $this->user, 403);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);
    }

    public function test_3()
    {
        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);

        $this->http_delete(route('admin.manufacturers.destroy', $this->manufacturer->id), null, 401);

        $this->assertDatabaseHas('manufacturers', [
            'id' => $this->manufacturer->id,
            'name' => $this->manufacturer->name,
            'image' => $this->manufacturer->image
        ]);
    }

    public function test_4()
    {
        $this->http_delete(route('admin.manufacturers.destroy', 12345), $this->admin, 404);
    }
}
