<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateNewTask;
use App\Dtos\Task\CreateTaskDto;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return TaskResource
     */
    public function index(Request $request)
    {
        return TaskResource::collection(
            Task::with('category')->filter($request->query())->paginate($request->get('limit', 25))
        );
    }

    /**
     * Display the specified resource.
     * @param Task $task
     */
    public function show(Task $task)
    {
        return new TaskResource($task->load('category'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $dto = CreateTaskDto::create($request->all());

        $task = CreateNewTask::handle($dto);

        return new TaskResource($task);
    }
}
