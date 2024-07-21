<?php

namespace App\Http\Controllers\Api;

use App\Actions\Comment\AddTaskComment;
use App\Dtos\Comment\AddTaskCommentDto;
use App\Http\Resources\CommentResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Task $task
     * @param Request $request
     */
    public function __invoke(Task $task, Request $request)
    {
        $dto = AddTaskCommentDto::create($request->all());

        $comment = AddTaskComment::handle($task, $dto);

        return new CommentResource($comment); 
    }
}
