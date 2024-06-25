<?php

namespace App\Actions\Tag;

use App\Dtos\Tag\AddTaskTagDto;
use App\Models\Task;

class AddTaskTags
{
    /**
     * Handle the create tag action
     * @param CreateTagDto $dto
     */
    public static function handle(Task $task, AddTaskTagDto $dto)
    {  
        return $task->tags()->attach($dto->tags);
    }
}
