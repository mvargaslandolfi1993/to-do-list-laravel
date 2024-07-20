<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Reminder;
use App\Models\Subtask;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tags = Tag::factory(5)->create();

        User::factory()->count(1)->has(
            Task::factory()
                ->count(100)
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                })
                ->hasAttached($tags)
                ->has(
                    Comment::factory()
                        ->count(100)
                        ->state(function (array $attributes, Task $task) {
                            return ['task_id' => $task->id, 'user_id' => $task->user_id];
                        })
                )
                ->has(
                    Subtask::factory()
                        ->count(100)
                        ->state(function (array $attributes, Task $task) {
                            return ['task_id' => $task->id];
                        })
                )
                ->has(
                    Reminder::factory()
                        ->count(100)
                        ->state(function (array $attributes, Task $task) {
                            return ['task_id' => $task->id];
                        })
                )
        )->create();

        // Task::factory()->count(100)->state(function (array $attributes, User $user) {
        //     return ['user_id' => $user->id];
        // })->hasAttached($tags)
        //     ->has(
        //         Comment::factory()
        //             ->count(100)
        //             ->state(function (array $attributes, Task $task) {
        //                 return ['task_id' => $task->id, 'user_id' => $task->user_id];
        //             })
        //     )
        //     ->has(
        //         Subtask::factory()
        //             ->count(100)
        //             ->state(function (array $attributes, Task $task) {
        //                 return ['task_id' => $task->id];
        //             })
        //     )
        //     ->has(
        //         Reminder::factory()
        //             ->count(100)
        //             ->state(function (array $attributes, Task $task) {
        //                 return ['task_id' => $task->id];
        //             })
        //     )
        //     ->create();
    }
}
