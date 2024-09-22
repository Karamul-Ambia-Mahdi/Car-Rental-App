<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index(Request $request)
    {
        // Available cars
        $cars = Car::where('availability', '=', 1)->get();

        // Search cars
        if ($request->input('search')) {

            $search = "%" . $request->input('search') . "%";

            $cars = Car::where('availability', '=', 1)
                ->where('name', 'LIKE', $search)
                ->get();
        }

        // Filter by type
        if ($request->input('type')) {
            $cars = $cars->where('car_type',  '=', $request->input('type'));
        }

        // Filter by brand
        if ($request->input('brand')) {
            $cars = $cars->where('brand',  '=', $request->input('brand'));
        }

        // Filter by price
        if ($request->input('price')) {
            $cars = $cars->where('daily_rent_price', '<=', $request->input('price'));
        }

        return $cars;
    }
}
