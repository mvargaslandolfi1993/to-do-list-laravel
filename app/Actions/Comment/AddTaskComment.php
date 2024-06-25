<?php

namespace App\Actions\Comment;

use App\Dtos\Comment\AddTaskCommentDto;
use App\Models\Comment;
use App\Models\Task;

class AddTaskComment
{
    /**
     * Handle adding a comment to a task.
     * @param Task $task
     * @param AddTaskCommentDto $dto
     */
    public static function handle(Task $task, AddTaskCommentDto $dto): Comment
    {  
        return $task->comments()->create((array) $dto);
    }
}
