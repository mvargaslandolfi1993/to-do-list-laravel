<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ReminderController;
use App\Http\Controllers\Api\SubtaskController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskTagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
    Route::apiResource('tasks', TaskController::class);

    Route::apiResource('categories', CategoryController::class)->except(['show', 'update', 'destroy']);

    Route::apiResource('tags', TagController::class)->except(['show', 'update', 'destroy']);

    Route::apiResource('subtasks', SubtaskController::class)->except(['show', 'update']);

    Route::post('/reminder', [ReminderController::class, 'store'])->name('reminder.store');

    Route::delete('/reminder/{reminder}', [ReminderController::class, 'destroy'])->name('reminder.destroy');

    Route::post('/tasks/{task}/comment', TaskCommentController::class)->name('tasks.comment.store');

    Route::post('/tasks/{task}/tags', [TaskTagController::class, 'store'])->name('tasks.tag.store');

    Route::delete('/tasks/{task}/tags/{tag}', [TaskTagController::class, 'remove'])->name('tasks.tag.destroy');
});
