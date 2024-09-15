<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::prefix('user')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
});
