<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\DebugController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
 

// Admin Routes
Route::prefix('administrator')->name('administrator.')->middleware(['auth'])->group(function () {
   
    Route::get('/', [AdminController::class, 'index'])->name('index');
   
    // User Management
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/data', [UserController::class, 'getData'])->name('data');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    // Role Management
    Route::prefix('role')->group(function () { 
        Route::get('/', [RoleController::class, 'index'])->name('roles.index'); 
        Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit'); 
        Route::put('/update/{role}', [RoleController::class, 'update'])->name('roles.update'); 
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store'); 
        Route::get('/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy'); 
    });
    Route::prefix('permission')->group(function () { 
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index'); 
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit'); 
        Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('permission.update'); 
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store'); 
        Route::get('/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy'); 
    });

    // Debug Image Upload Routes (hanya untuk troubleshooting)
    Route::prefix('debug')->name('debug.')->group(function () {
        Route::get('/image-upload', [DebugController::class, 'index'])->name('index');
        Route::post('/image-upload', [DebugController::class, 'upload'])->name('upload');
    });
});

require __DIR__.'/auth.php';
