<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateNewTask;
use App\Dtos\Task\CreateTaskDto;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $dto = CreateTaskDto::create($request->all());
        
        $task = CreateNewTask::create($dto);

        return response()->json($task, 201);
    }
}
