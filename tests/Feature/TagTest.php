<?php

namespace Tests\Feature;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Test if the tags index route returns a 200 status code.
     */
    public function test_tags_index_route(): void
    {
        $response = $this->get(route('tags.index'));
        $response->assertStatus(200);
    }

    /**
     * Test if a tag can be created.
     */
    public function test_tag_creation(): void
    {
        $tag_data = Tag::factory()->make()->toArray();

        $response = $this->post(route('tags.store'), $tag_data);
        $response->assertStatus(201);

        $this->assertDatabaseHas('tags', $tag_data);
    }

    /**
     * Test if a tags can be created with validation errors.
     */
    public function test_tags_creation_validation(): void
    {
        $response = $this->postJson(route('tags.store'), []);
        $response->assertStatus(422)->assertJsonValidationErrors(['name']);
    }
}
