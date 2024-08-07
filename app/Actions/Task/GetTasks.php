<?php

namespace App\Actions\Task;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GetTasks
{
    /**
     * Retrieve all tasks.
     */
    public static function handle(array $qs): Paginator
    {
        return Task::with(
            [
                'category',
                'comments' => function (HasMany $query) {
                    return $query->take(3)->orderby('created_at', 'desc');
                },
                'subtasks' => function (HasMany $query) {
                    return $query->take(3)->orderby('created_at', 'desc');
                }
            ]
        )->filter($qs)->orderBy('created_at', 'desc')->paginate($qs['limit'] ?? 25);
    }
}
