<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMidlleware;
use App\Http\Middleware\ManagerMidlleware;
use App\Http\Middleware\UserMidlleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class,'redirect'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(AdminMidlleware::class)->group(function () {
    //admin routes
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/add_manager', [AdminController::class, 'createManager'])->name('admin.createManager');
    Route::post('/add_manager', [AdminController::class, 'storeManager'])->name('admin.storeManager');
    Route::get('/add_admin', [AdminController::class, 'createAdmin'])->name('admin.createAdmin');
    Route::post('/store_admin', [AdminController::class, 'storeAdmin'])->name('admin.storeAdmin');
    Route::get('/all_tasks', [AdminController::class, 'allTasks'])->name('admin.allTasks');
    Route::get('/all_users', [AdminController::class, 'allUsers'])->name('admin.allUsers');
});

Route::middleware(ManagerMidlleware::class)->group(function () {
    //manager routes
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])->name('manager.dashboard');
    Route::get('/create_task', [ManagerController::class, 'createTask'])->name('manager.createTask');
    Route::post('/store_task', [ManagerController::class, 'storeTask'])->name('manager.storeTask');
    Route::get('/manager_tasks', [ManagerController::class, 'addedTasks'])->name('manager.addedTasks');
    Route::get('/edit_task/{taskId}', [ManagerController::class, 'editTask'])->name('manager.editTask');
    Route::put('/update_task/{taskId}', [ManagerController::class, 'updateTask'])->name('manager.updateTask');
});

Route::middleware(UserMidlleware::class)->group(function () {
    //user routes
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/my_tasks', [UserController::class, 'myTasks'])->name('user.myTasks');
    Route::get('/update_task/{taskId}/{statusId}', [UserController::class, 'updateTaskStatus'])->name('user.updateTaskStatus');
});


require __DIR__.'/auth.php';
