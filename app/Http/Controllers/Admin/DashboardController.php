<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $total_cars = Car::count();
        $total_available_cars = Car::where('availability', '=', 1)->count();
        $total_rentals = Rental::where('status', '!=', 'Canceled')->count();
        $total_earnings = Rental::where('status', '!=', 'Canceled')->sum('total_cost');

        return [
            'total_cars' => $total_cars,
            'total_available_cars' => $total_available_cars,
            'total_rentals' => $total_rentals,
            'total_earnings' => $total_earnings
        ];
    }
}
