<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the tasks index route returns a 200 status code.
     */
    public function test_tasks_index_route(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertStatus(200);
    }

    /**
     * Test if the tasks show route returns a 200 status code.
     */
    public function test_tasks_show_route(): void
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', $task->id));
        $response->assertStatus(200);
    }

    /**
     * Test if the tasks show route returns a 404 status code when the task does not exist.
     */
    public function test_tasks_show_route_with_incorrect_id(): void
    {
        $response = $this->get(route('tasks.show', 999));
        $response->assertStatus(404);
    }
    /**
     * Test if a task can be created.
     */
    public function test_task_creation(): void
    {
        $user = User::factory()->create();

        $category = Category::factory()->create();

        $taskData = [
            'title' => 'New Task',
            'description' => 'This is a new task',
            'status' => Task::PENDING_STATUS,
            'due_date' => now()->addDays(7),
            'priority' => 1,
            'category_id' => $category->id,
            'user_id' => $user->id,
        ];

        $response = $this->post(route('tasks.store'), $taskData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $taskData);
    }

    /**
     * Test if a task can be created with validation errors.
     */
    public function test_task_creation_validation(): void
    {
        $response = $this->postJson(route('tasks.store'), []);
        $response->assertStatus(422)->assertJsonValidationErrors([
            'title',
            'description',
            'due_date',
            'category_id',
            'user_id',
        ]);
    }

    /**
     * Test if a task can be deleted.
     */
    public function test_task_deletion(): void
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task->id));

        $response->assertStatus(204);
    }

    /**
     * Test if a task can be deleted with an incorrect id.
     */
    public function test_task_deletion_with_incorrect_id(): void
    {
        $response = $this->delete(route('tasks.destroy', 999));

        $response->assertStatus(404);
    }
}
