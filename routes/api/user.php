<?php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::prefix('user')->group(function () {
    Route::middleware(['auth:sanctum', 'auth.user'])->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::patch('/revokeRole/{id}', [UserController::class, 'revokeRole'])->middleware('role:Admin');
        Route::patch('/assignRoleToStaff/{id}', [UserController::class, 'assignRoleToStaff'])->middleware('role:Admin');
    });
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/{id}', [UserController::class, 'getById']);
    Route::get('/', [UserController::class, 'get']);
    Route::get('/getUserByRole/{role}', [UserController::class, 'getUserByRole']);
});
