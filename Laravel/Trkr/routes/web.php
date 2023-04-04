<?php

use App\Http\Controllers\admin\GoalController as AdminGoalController;
use App\Http\Controllers\admin\TaskController as AdminTaskController;
use App\Http\Controllers\user\GoalController as UserGoalController;

// use App\Http\Controllers\GoalController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Allows only logged in authorised users to access the tvshows page
Route::resource('/admin/goals', AdminGoalController::class)->middleware(['auth'])->names('admin.goals');
Route::resource('/tasks', TaskController::class)->middleware(['auth'])->except('create, edit');

// Routes created seperately in order to pass the goal id through to the task create and edit views
Route::get('/admin/tasks/{id}/create', [App\Http\Controllers\AdminTaskController::class, 'create'])->name('tasks.create');
Route::get('/admin/tasks/{id}/edit', [App\Http\Controllers\AdminTaskController::class, 'edit'])->name('tasks.edit');

