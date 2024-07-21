<?php

namespace App\Http\Controllers\Api;

use App\Actions\Task\CreateNewTask;
use App\Actions\Task\FindTask;
use App\Actions\Task\GetTasks;
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
            GetTasks::handle($request->query())
        );
    }

    /**
     * Display the specified resource.
     * @param Task $task
     */
    public function show(Task $task)
    {
        return new TaskResource(FindTask::handle($task->id));
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

    /**
     * Delete the specified resource.
     * @param Task $task
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response(null, 204);
    }
}
