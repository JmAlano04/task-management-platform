<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'verified'])->group(function () {
     
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
   
    //Creator Routes
    Route::middleware(['role:creator'])->group(function () {
        Route::get('/Create/management', [TaskController::class, 'taskManagement'])->name('createTask');
         Route::get('/Create/search', [TaskController::class, 'searchCreate'])
        ->name('create.search');
        Route::post('/Create/management/store', [TaskController::class, 'createTaskstore'])->name('createtask.store');
        Route::put('/Create/management/{id}', [TaskController::class, 'createTaskupdate'])->name('createtask.update');
        Route::delete('/Create/management/{id}', [TaskController::class, 'createTaskdestroy'])->name('createtask.destroy');   
    });

    // Task taker routes
    Route::middleware(['role:taker'])->group(function () {
        Route::get('/tasks/my', [TaskController::class, 'mytask'])->name('tasks.my');
        Route::post('/tasks/{task}/start', [TaskController::class, 'start'])->name('tasks.start');
        Route::post('/tasks/{task}/complete', [TaskController::class, 'complete'])->name('tasks.complete');
    });

    // Admin
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/manage/filter', [AdminController::class, 'filter'])->name('manage.index');
        Route::get('/manage/user', [AdminController::class, 'manage'])->name('manage-account');
        Route::get('/manage/search', [AdminController::class, 'search'])
        ->name('users.search');
        Route::post('/manage/admin/store', [AdminController::class, 'store'])->name('users.store');
        Route::put('/manage/admin/{user}', [AdminController::class, 'update'])->name('users.update');
        Route::delete('/manage/admin/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

        Route::get('/task-management/', [TaskController::class, 'taskManagement'])->name('task-management');
         Route::get('/task-management/search', [TaskController::class, 'search'])
        ->name('task-management.search');
        Route::post('/task-management/store', [TaskController::class, 'store'])->name('task.store');
        Route::put('/task-management/{id}', [TaskController::class, 'update'])->name('task.update');
        Route::delete('/task-management/destroy/{id}', [TaskController::class, 'destroy'])->name('task-management.destroy');
    });
});
require __DIR__.'/auth.php';
