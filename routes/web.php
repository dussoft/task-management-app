<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::resource('tasks', TaskController::class)->except(['index'])->names('tasks');
Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');
