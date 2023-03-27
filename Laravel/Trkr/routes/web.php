<?php

use App\Http\Controllers\GoalController;
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
Route::resource('/goals', GoalController::class)->middleware(['auth']);
Route::resource('/tasks', TaskController::class)->middleware(['auth'])->except('create, edit');

Route::get('/tasks/{id}/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::get('/tasks/{id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');

