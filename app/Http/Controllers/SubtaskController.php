<?php

namespace App\Http\Controllers;

use App\Actions\SubTask\CreateSubTask;
use App\Dtos\SubTask\CreateSubTaskDto;
use App\Http\Resources\SubTaskResource;
use App\Models\Subtask;
use Illuminate\Http\Request;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return SubTaskResource
     */
    public function index(Request $request)
    {
        return SubTaskResource::collection(
            Subtask::with('task')->paginate($request->get('limit', 25))
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return SubTaskResource
     */
    public function store(Request $request)
    {
        $dto = CreateSubTaskDto::create($request->all());

        $subtask = CreateSubTask::handle($dto);

        return new SubTaskResource($subtask);
    }

    /**
     * Delete the specified resource.
     * @param Subtask $subtask
     */
    public function destroy(Subtask $subtask)
    {
        $subtask->delete();

        return response(null, 204);
    }
}
