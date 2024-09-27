<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    // public function index(){
    //     $available_cars  =  Car::where('availability', '=', 1)->get();
    //     $ongoing_cars  =  Car::where('availability', '=', 0)->get();

    //     return [
    //         'available_cars' => $available_cars,
    //         'ongoing_cars' => $ongoing_cars
    //     ];
    // }

    public function index(Request $request)
    {
        $search = "%" . $request->input('search') . "%";
        $type = $request->input('type');
        $brand = $request->input('brand');
        $price = $request->input('price');

        $available_cars = Car::where('availability', '=', 1)
            ->when($search,  function ($query) use ($search) {
                $query->where('name', 'LIKE', $search);
            })
            ->when($type,  function ($query) use ($type) {
                $query->where('car_type', '=', $type);
            })
            ->when($brand,  function ($query) use ($brand) {
                $query->where('brand', '=', $brand);
            })
            ->when($price,  function ($query) use ($price) {
                $query->where('daily_rent_price', '<=', $price);
            })
            ->get();

        $ongoing_cars = Car::where('availability', '=', 0)
            ->when($search,  function ($query) use ($search) {
                $query->where('name', 'LIKE', $search);
            })
            ->when($type,  function ($query) use ($type) {
                $query->where('car_type', '=', $type);
            })
            ->when($brand,  function ($query) use ($brand) {
                $query->where('brand', '=', $brand);
            })
            ->when($price,  function ($query) use ($price) {
                $query->where('daily_rent_price', '<=', $price);
            })
            ->get();

        return [
            'available_cars' => $available_cars,
            'ongoing_cars' => $ongoing_cars
        ];
    }
}
