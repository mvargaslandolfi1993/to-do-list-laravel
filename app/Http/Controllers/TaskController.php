<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateNewTask;
use App\Actions\Task\FindTask;
use App\Actions\Task\GetTasks;
use App\Dtos\Task\CreateTaskDto;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
  public function index(Request $request)
  {
    $tasks = GetTasks::handle($request->query());

    return Inertia::render('Tasks/Index', [
      'tasks' => $tasks
    ]);
  }
  /**
   * Display the specified resource.
   * @param Task $task
   */
  public function show($task_id)
  {
    $task = FindTask::handle($task_id);

    return Inertia::render('Tasks/Show', [
      'task' => $task
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return Inertia::render('Tasks/Store');
  }
  /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $dto = CreateTaskDto::create($request->all());

        CreateNewTask::handle($dto);

        return to_route('tasks.index');
    }
}
