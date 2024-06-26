<?php

namespace App\Actions\SubTask;

use App\Dtos\SubTask\CreateSubTaskDto;
use App\Models\Subtask;

class CreateSubTask
{
    /**
     * Create a new subtask.
     * @param CreateSubTaskDto $dto
     */
    public static function handle(CreateSubTaskDto $dto): Subtask
    {  
        return Subtask::create((array) $dto);
    }
}
