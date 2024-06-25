<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', TaskController::class);

Route::apiResource('categories', CategoryController::class)->except(['show', 'update', 'destroy']);

Route::apiResource('tags', TagController::class)->except(['show', 'update', 'destroy']);

Route::post('/tasks/{task}/comment', TaskCommentController::class)->name('tasks.comment.store');