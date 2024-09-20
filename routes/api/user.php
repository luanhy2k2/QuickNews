<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::prefix('user')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
    });
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/{id}', [UserController::class, 'getById']);
});
