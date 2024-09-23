<?php
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
Route::prefix('tag')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create', [TagController::class, 'create'])->middleware('role:Admin,Editor');
        Route::put('/update', [TagController::class, 'update'])->middleware('role:Admin,Editor');
        Route::delete('/delete/{id}', [TagController::class, 'delete'])->middleware('role:Admin,Editor');
    });
    Route::get('/getAll', [TagController::class, 'getAll']);
    Route::get('/{id}', [TagController::class, 'find']);
    Route::get('/', [TagController::class, 'get']);
});

