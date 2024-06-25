<?php

namespace App\Actions\Task;

use App\Dtos\Task\CreateTaskDto;
use App\Models\Task;

class CreateNewTask
{
    /**
     * Create a new task.
     * @param CreateTaskDto $dto
     */
    public static function handle(CreateTaskDto $dto): Task
    {  
        return Task::create((array) $dto);
    }
}
