<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\LocationCategoryController;
use App\Http\Controllers\Admin\LocationSubCategoryController;
use App\Http\Controllers\Admin\LocationTypeController;
use App\Http\Controllers\Admin\PremiumPlanController;
use App\Http\Controllers\Admin\AppSliderController;
use App\Http\Controllers\DebugController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'frontpage']);

Route::get('/search', function () {
    return view('search');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/collections', function () {
    return view('collections');
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
    
    // Permission Management
    Route::prefix('permission')->group(function () { 
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index'); 
        Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit'); 
        Route::put('/update/{permission}', [PermissionController::class, 'update'])->name('permission.update'); 
        Route::post('/store', [PermissionController::class, 'store'])->name('permission.store'); 
        Route::get('/delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy'); 
    });

    Route::prefix('setting')->group(function () { 
    // Province Management
        Route::prefix('provinces')->group(function () { 
            Route::get('/', [ProvinceController::class, 'index'])->name('provinces.index'); 
            Route::get('/edit/{id}', [ProvinceController::class, 'edit'])->name('provinces.edit'); 
            Route::put('/update/{id}', [ProvinceController::class, 'update'])->name('provinces.update'); 
            Route::post('/store', [ProvinceController::class, 'store'])->name('provinces.store'); 
            Route::get('/delete/{id}', [ProvinceController::class, 'destroy'])->name('provinces.destroy'); 
        });

        // City Management
        Route::prefix('cities')->group(function () { 
            Route::get('/', [CityController::class, 'index'])->name('cities.index'); 
            Route::get('/edit/{id}', [CityController::class, 'edit'])->name('cities.edit'); 
            Route::put('/update/{id}', [CityController::class, 'update'])->name('cities.update'); 
            Route::post('/store', [CityController::class, 'store'])->name('cities.store'); 
            Route::get('/delete/{id}', [CityController::class, 'destroy'])->name('cities.destroy'); 
        });
    });

    Route::prefix('location')->group(function () { 
       // Location Category Management
            Route::prefix('category')->group(function () { 
                Route::get('/', [LocationCategoryController::class, 'index'])->name('location-categories.index'); 
                Route::get('/edit/{id}', [LocationCategoryController::class, 'edit'])->name('location-categories.edit'); 
                Route::put('/update/{id}', [LocationCategoryController::class, 'update'])->name('location-categories.update'); 
                Route::post('/store', [LocationCategoryController::class, 'store'])->name('location-categories.store'); 
                Route::get('/delete/{id}', [LocationCategoryController::class, 'destroy'])->name('location-categories.destroy'); 
            });

            // Location Subcategory Management
            Route::prefix('sub-category')->group(function () { 
                Route::get('/', [LocationSubCategoryController::class, 'index'])->name('location-subcategories.index'); 
                Route::get('/edit/{id}', [LocationSubCategoryController::class, 'edit'])->name('location-subcategories.edit'); 
                Route::put('/update/{id}', [LocationSubCategoryController::class, 'update'])->name('location-subcategories.update'); 
                Route::post('/store', [LocationSubCategoryController::class, 'store'])->name('location-subcategories.store'); 
                Route::get('/delete/{id}', [LocationSubCategoryController::class, 'destroy'])->name('location-subcategories.destroy'); 
            });

            // Location Type Management
            Route::prefix('type')->group(function () { 
                Route::get('/', [LocationTypeController::class, 'index'])->name('location-types.index'); 
                Route::get('/edit/{id}', [LocationTypeController::class, 'edit'])->name('location-types.edit'); 
                Route::put('/update/{id}', [LocationTypeController::class, 'update'])->name('location-types.update'); 
                Route::post('/store', [LocationTypeController::class, 'store'])->name('location-types.store'); 
                Route::get('/delete/{id}', [LocationTypeController::class, 'destroy'])->name('location-types.destroy'); 
            });

            // Location Management
            Route::get('/', [App\Http\Controllers\Admin\LocationController::class, 'index'])->name('location.index');
            Route::get('/create', [App\Http\Controllers\Admin\LocationController::class, 'create'])->name('location.create');
            Route::post('/store', [App\Http\Controllers\Admin\LocationController::class, 'store'])->name('location.store');
            Route::get('/edit/{id}', [App\Http\Controllers\Admin\LocationController::class, 'edit'])->name('location.edit');
            Route::put('/update/{id}', [App\Http\Controllers\Admin\LocationController::class, 'update'])->name('location.update');
            Route::get('/delete/{id}', [App\Http\Controllers\Admin\LocationController::class, 'destroy'])->name('location.destroy');
            Route::get('/get-cities/{provinceId}', [App\Http\Controllers\Admin\LocationController::class, 'getCities'])->name('location.getCities');
            Route::delete('/photo/{id}', [App\Http\Controllers\Admin\LocationController::class, 'deletePhoto'])->name('location.deletePhoto');
            Route::post('/photo/{locationId}/set-primary/{photoId}', [App\Http\Controllers\Admin\LocationController::class, 'setPrimaryPhoto'])->name('location.setPrimaryPhoto');

            // Tambahkan route map
            Route::get('/map', [App\Http\Controllers\Admin\LocationController::class, 'map'])->name('location.map');
    });

    // Premium Plan Management
    Route::prefix('premium')->group(function () { 
            Route::get('/', [PremiumPlanController::class, 'index'])->name('premium-plans.index'); 
            Route::get('/edit/{id}', [PremiumPlanController::class, 'edit'])->name('premium-plans.edit'); 
            Route::put('/update/{id}', [PremiumPlanController::class, 'update'])->name('premium-plans.update'); 
            Route::post('/store', [PremiumPlanController::class, 'store'])->name('premium-plans.store'); 
            Route::get('/delete/{id}', [PremiumPlanController::class, 'destroy'])->name('premium-plans.destroy'); 
        
    });
    
    // App Slider Management
    Route::prefix('slider')->group(function () {
        Route::get('/', [AppSliderController::class, 'index'])->name('slider.index');
        Route::post('/store', [AppSliderController::class, 'store'])->name('slider.store');
        Route::get('/edit/{id}', [AppSliderController::class, 'edit'])->name('slider.edit');
        Route::post('/update/{id}', [AppSliderController::class, 'update'])->name('slider.update');
        Route::delete('/delete/{id}', [AppSliderController::class, 'destroy'])->name('slider.destroy');
    });
});

require __DIR__.'/auth.php';
