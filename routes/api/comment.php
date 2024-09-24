<?php
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
Route::prefix('comment')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/create', [CommentController::class, 'create'])->middleware('role:Admin,Editor,Author,Client');
        Route::patch('/updateStatus/{id}', [CommentController::class, 'updateStatus'])->middleware('role:Admin,Editor');
        Route::delete('/delete/{id}', [CommentController::class, 'delete'])->middleware('role:Admin,Editor');
    });
    Route::get('/{id}', [CommentController::class, 'get']);
});

