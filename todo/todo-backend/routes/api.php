<?php

use App\Http\Controllers\TaskController;

Route::get('tasks', [TaskController::class, 'index']);        // GET all tasks
Route::get('tasks/{id}', [TaskController::class, 'show']);    // GET single task
Route::post('tasks', [TaskController::class, 'store']);       // POST create task
Route::put('tasks/{id}', [TaskController::class, 'update']);  // PUT update task
Route::delete('tasks/{id}', [TaskController::class, 'destroy']); // DELETE task
