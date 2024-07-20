<?php

namespace App\Actions\Task;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetTasks
{
    /**
     * Retrieve all tasks.
     */
    public static function handle(array $qs): AnonymousResourceCollection
    {
        return TaskResource::collection(
            Task::with(
                [
                    'category',
                    'comments' => function (HasMany $query) {
                        return $query->take(3)->orderby('created_at', 'desc');
                    },
                    'subtasks' => function (HasMany $query) {
                        return $query->take(3)->orderby('created_at', 'desc');
                    }
                ]
            )->filter($qs)->paginate($qs['limit'] ?? 25)
        );
    }
}
