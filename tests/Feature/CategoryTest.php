<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_categories_index_route(): void
    {
        $response = $this->get(route('categories.index'));
        $response->assertStatus(200);
    }

    /**
     * Test if a category can be created.
     */
    public function test_categories_create_route(): void
    {
        $category_data = Category::factory()->make()->toArray();

        $response = $this->post(route('categories.store'), $category_data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', $category_data);

    }

    /**
     * Test if a categories can be created with validation errors.
     */
    public function test_categories_creation_validation(): void
    {
        $response = $this->postJson(route('categories.store'), []);
        $response->assertStatus(422)->assertJsonValidationErrors(['name']);

    }
}
