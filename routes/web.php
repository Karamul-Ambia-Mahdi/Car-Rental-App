<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CarController;


// User Authentication API
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);



Route::middleware(['admin'])->group(function () {

    // Car API
    Route::get('/car-list', [CarController::class, 'carList']);
    Route::post('/car-create', [CarController::class, 'carCreate']);
    Route::get('/car-by-id', [CarController::class, 'carById']);
    Route::post('/car-update', [CarController::class, 'carUpdate']);
    Route::post('/car-delete', [CarController::class, 'carDelete']);
});