<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\RentalController;
use App\Http\Controllers\Admin\CustomerController;


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



    // Customer API
    Route::get('/customer-list', [CustomerController::class, 'customerList']);
    Route::post('/customer-create', [CustomerController::class, 'customerCreate']);
    Route::get('/customer-by-id', [CustomerController::class, 'customerById']);
    Route::post('/customer-update', [CustomerController::class, 'customerUpdate']);
    Route::post('/customer-delete', [CustomerController::class, 'customerDelete']);



    // Rental API
    Route::get('/rental-list', [RentalController::class, 'rentalList']);
    Route::post('/rental-create/{startDate}/{endDate}', [RentalController::class, 'rentalCreate']);
    Route::get('/rental-by-id', [RentalController::class, 'rentalById']);
    Route::post('/rental-update/{startDate}/{endDate}', [RentalController::class, 'rentalUpdate']);
    Route::post('/rental-delete', [RentalController::class, 'rentalDelete']);
});
