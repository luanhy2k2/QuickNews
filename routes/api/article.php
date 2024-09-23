<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::prefix('article')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/create', [ArticleController::class, 'create'])->middleware('role:Admin,Editor,Author');
        Route::put('/update/{id}', [ArticleController::class, 'update'])->middleware('role:Admin,Editor,Author');
        Route::delete('/delete/{id}', [ArticleController::class, 'delete'])->middleware('role:Admin,Editor,Author');
        Route::patch('/updateStatus/{id}', [ArticleController::class, 'updateStatus'])->middleware('role:Admin,Editor');
    });
    Route::get('/most-popular', [ArticleController::class, 'mostPopular']);
    Route::get('/getByCategoryId', [ArticleController::class, 'getByCategoryId']);
    Route::get('/trending', [ArticleController::class, 'trending']);
    Route::get('/most-interaction', [ArticleController::class, 'mostInteraction']);
    Route::get('/{id}', [ArticleController::class, 'find']);
    Route::get('/', [ArticleController::class, 'get']);

    Route::post('/upload', [ArticleController::class, 'uploadFile']);
    Route::delete('/deleteFile', [ArticleController::class, 'deleteFile']);
});


