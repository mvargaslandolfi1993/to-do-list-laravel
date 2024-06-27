<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Reminder;
use App\Models\Subtask;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory(5)->create();

        Task::factory(3)->hasAttached($tags)
            ->has(
                Comment::factory()
                    ->count(3)
                    ->state(function (array $attributes, Task $task) {
                        return ['task_id' => $task->id, 'user_id' => $task->user_id];
                    })
            )
            ->has(
                Subtask::factory()
                    ->count(1)
                    ->state(function (array $attributes, Task $task) {
                        return ['task_id' => $task->id];
                    })
            )
            ->has(
                Reminder::factory()
                    ->count(1)
                    ->state(function (array $attributes, Task $task) {
                        return ['task_id' => $task->id];
                    })
            )
            ->create();
    }
}
