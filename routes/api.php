<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskTagController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', TaskController::class);

Route::apiResource('categories', CategoryController::class)->except(['show', 'update', 'destroy']);

Route::apiResource('tags', TagController::class)->except(['show', 'update', 'destroy']);

Route::apiResource('subtasks', SubtaskController::class)->except(['show', 'update']);

Route::post('/reminder', [ReminderController::class, 'store'])->name('reminder.store');

Route::delete('/reminder/{reminder}', [ReminderController::class, 'destroy'])->name('reminder.destroy');

Route::post('/tasks/{task}/comment', TaskCommentController::class)->name('tasks.comment.store');

Route::post('/tasks/{task}/tags', [TaskTagController::class, 'store'])->name('tasks.tag.store');

Route::delete('/tasks/{task}/tags/{tag}', [TaskTagController::class, 'remove'])->name('tasks.tag.destroy');