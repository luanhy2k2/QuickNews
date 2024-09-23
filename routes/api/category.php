<?php
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
Route::prefix('category')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/create', [CategoryController::class, 'create'])->middleware('role:Admin,Editor');
        Route::put('/update', [CategoryController::class, 'update'])->middleware('role:Admin,Editor');
        Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->middleware('role:Admin,Editor');
    });
    Route::get('/{id}', [CategoryController::class, 'find']);
    Route::get('/', [CategoryController::class, 'get']);
});

