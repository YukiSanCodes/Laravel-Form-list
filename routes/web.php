<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');

Route::get('about', [PageController::class, 'about']);

Route::get('tasks/{id}', [PageController::class, 'tasks']);

Route::get('tasks', [TaskController::class, 'index'])->name('tasks.index');

Route::post('tasks', [TaskController::class, 'store'])->name('tasks.store');
