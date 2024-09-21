<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
Route::prefix('article')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/create', [ArticleController::class, 'create']);
        Route::put('/update', [ArticleController::class, 'update']);
        Route::delete('/delete/{id}', [ArticleController::class, 'delete']);

    });
    Route::get('/{id}', [ArticleController::class, 'find']);
    Route::get('/', [ArticleController::class, 'get']);
    Route::post('/upload', [ArticleController::class, 'uploadFile']);
    Route::post('/deleteFile', [ArticleController::class, 'deleteFile']);
});

