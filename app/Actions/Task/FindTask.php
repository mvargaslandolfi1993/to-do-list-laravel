<?php

namespace App\Actions\Task;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class FindTask
{
    /**
     * Retrieve all tasks.
     */
    public static function handle(string $task_id): Task
    {
        return Task::with(
            [
                'category',
                'comments' => function (HasMany $query) {
                    return $query->take(3)->orderby('created_at', 'desc');
                },
                'subtasks' => function (HasMany $query) {
                    return $query->take(3)->orderby('created_at', 'desc');
                },
                'tags',
                'reminders' => function (HasMany $query) {
                    return $query->take(3)->orderby('remind_at', 'asc');
                },
            ]
        )->findOrFail($task_id);
    }
}
