<?php
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
Route::prefix('tag')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create', [TagController::class, 'create']);
        Route::put('/update', [TagController::class, 'update']);
        Route::delete('/delete/{id}', [TagController::class, 'delete']);
    });
    Route::get('/{id}', [TagController::class, 'find']);
    Route::get('/', [TagController::class, 'get']);
});

