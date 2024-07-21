<?php

namespace App\Http\Controllers\Api;

use App\Actions\Tag\AddTaskTags;
use App\Dtos\Tag\AddTaskTagDto;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $dto = AddTaskTagDto::create($request->all(), $task->id);

        AddTaskTags::handle($task, $dto);

        return response(null, 201);
    }
}
