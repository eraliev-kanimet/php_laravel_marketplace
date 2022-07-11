<?php

namespace Tests\Feature\Admin\Categories;

use App\Models\Category\Category;
use Laravel\Passport\Passport;
use Tests\TestCase;

class GetTest extends TestCase
{
    /**
     * @var Category
     */
    protected Category $category;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Category::create([
            'category_id' => null,
            'title' => $this->faker->name,
            'image' => 'image.jpg'
        ]);
        Category::create([
            'category_id' => 1,
            'title' => $this->faker->name,
            'image' => 'image.jpg'
        ]);
        $this->category = Category::find(1);
    }

    /**
     * @return void
     */
    public function test_successfully_getting_categories_with_category_id_properties_null(): void
    {
        Passport::actingAs($this->user, [route('admin.categories.index')]);
        $res = $this->getJson(route('admin.categories.index'));
        $res->assertStatus(200);
        $res->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'title',
                    'category_id',
                    'image'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_unable_to_get_categories_with_category_id_properties_null(): void
    {
        $res = $this->getJson(route('admin.categories.index'));
        $res->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_successfully_getting_all_categories(): void
    {
        Passport::actingAs($this->user, [route('admin.categories.all')]);
        $res = $this->getJson(route('admin.categories.all'));
        $res->assertStatus(200);
        $res->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'title',
                    'category_id',
                    'image'
                ]
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_unable_to_get_all_categories(): void
    {
        $res = $this->getJson(route('admin.categories.all'));
        $res->assertStatus(401);
    }

    /**
     * @return void
     */
    public function test_unable_to_get_category_categories(): void
    {
        Passport::actingAs($this->user, [route('admin.categories.show', $this->category)]);
        $res = $this->getJson(route('admin.categories.show', $this->category));
        $res->assertStatus(200);
        $res->assertJsonStructure([
            'data' => [
                [
                    'id',
                    'title',
                    'category_id',
                    'image'
                ]
            ],
            'category' => [
                'id',
                'title',
                'category_id',
                'image'
            ]
        ]);
    }

    /**
     * @return void
     */
    public function test_not_successfully_getting_categories_with_category(): void
    {
        $res = $this->getJson(route('admin.categories.show', $this->category));
        $res->assertStatus(401);
    }
}
