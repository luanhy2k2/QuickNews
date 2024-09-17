<?php

use App\Http\Controllers\ArticleTagController;
use Illuminate\Support\Facades\Route;
Route::prefix('articleTag')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/create', [ArticleTagController::class, 'create']);
        Route::put('/update', [ArticleTagController::class, 'update']);
        Route::delete('/delete/{id}', [ArticleTagController::class, 'delete']);
    });
    Route::get('/{id}', [ArticleTagController::class, 'find']);
    Route::get('/', [ArticleTagController::class, 'get']);
});

