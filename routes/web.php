<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Frontend\CarController as FrontendCarController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;


// User Authentication API
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);



Route::middleware(['admin'])->group(function () {

    // Car API
    Route::get('/car-list', [AdminCarController::class, 'carList']);
    Route::post('/car-create', [AdminCarController::class, 'carCreate']);
    Route::get('/car-by-id', [AdminCarController::class, 'carById']);
    Route::post('/car-update', [AdminCarController::class, 'carUpdate']);
    Route::post('/car-delete', [AdminCarController::class, 'carDelete']);



    // Customer API
    Route::get('/customer-list', [AdminCustomerController::class, 'customerList']);
    Route::post('/customer-create', [AdminCustomerController::class, 'customerCreate']);
    Route::get('/customer-by-id', [AdminCustomerController::class, 'customerById']);
    Route::post('/customer-update', [AdminCustomerController::class, 'customerUpdate']);
    Route::post('/customer-delete', [AdminCustomerController::class, 'customerDelete']);



    // Rental API
    Route::get('/rental-list', [AdminRentalController::class, 'rentalList']);
    Route::post('/rental-create/{startDate}/{endDate}', [AdminRentalController::class, 'rentalCreate']);
    Route::get('/rental-by-id', [AdminRentalController::class, 'rentalById']);
    Route::post('/rental-update/{startDate}/{endDate}', [AdminRentalController::class, 'rentalUpdate']);
    Route::post('/rental-delete', [AdminRentalController::class, 'rentalDelete']);



    // Dashboard API
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
});



// Car List
Route::get('/cars', [FrontendCarController::class, 'index']);

Route::middleware(['customer'])->group(function () {

    //Rental API
    Route::get('/rentals', [FrontendRentalController::class, 'rentalList']);
    Route::post('/create-rental/{startDate}/{endDate}', [FrontendRentalController::class, 'rentalCreate']);
    Route::get('/rental-via-id', [FrontendRentalController::class, 'rentalById']);
    Route::post('/update-rental/{startDate}/{endDate}', [FrontendRentalController::class, 'rentalUpdate']);
    Route::post('/cancel-rental', [FrontendRentalController::class, 'rentalCancel']);
});