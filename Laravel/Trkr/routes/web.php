<?php

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\admin\GoalController as AdminGoalController;
use App\Http\Controllers\user\GoalController as UserGoalController;

use App\Http\Controllers\admin\TaskController as AdminTaskController;
use App\Http\Controllers\user\TaskController as UserTaskController;

use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\UserController as UserUserController;

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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home.dashboard');
Route::get('/goals', [App\Http\Controllers\HomeController::class, 'indexGoals'])->name('home.indexGoals');
Route::get('/users', [App\Http\Controllers\HomeController::class, 'indexUsers'])->name('home.indexUsers');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('home.profile');
// Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user.users.dashboard');
// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('user.users.dashboard');

// Allows only logged in authorised users to access the tvshows page
Route::resource('/admin/goals', AdminGoalController::class)->middleware(['auth'])->names('admin.goals');
Route::resource('/admin/tasks', AdminTaskController::class)->middleware(['auth'])->names('admin.tasks')->except('create, edit');
Route::resource('/admin/users', AdminUserController::class)->middleware(['auth'])->names('admin.users');

// Routes created seperately in order to pass the goal id through to the task create and edit views
Route::get('/admin/tasks/{id}/create', [AdminTaskController::class, 'create'])->name('admin.tasks.create');
Route::get('/admin/tasks/{id}/edit', [AdminTaskController::class, 'edit'])->name('admin.tasks.edit');


// Allows only logged in authorised users to access the tvshows page
Route::resource('/user/goals', UserGoalController::class)->middleware(['auth'])->names('user.goals');
Route::resource('/user/tasks', UserTaskController::class)->middleware(['auth'])->names('user.tasks')->except('create, edit');
Route::resource('/user/users', UserUserController::class)->middleware(['auth'])->names('user.users')->except('destroy');


// Routes created seperately in order to pass the goal id through to the task create and edit views
Route::get('/user/tasks/{id}/create', [UserTaskController::class, 'create'])->name('user.tasks.create');
Route::get('/user/tasks/{id}/edit', [UserTaskController::class, 'edit'])->name('user.tasks.edit');
