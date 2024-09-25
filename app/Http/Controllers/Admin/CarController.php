<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    public function carList()
    {
        $cars = Car::all();

        foreach ($cars as $car) {
            $car->availability ? $car->availability = 'Available' : $car->availability = 'Not Available';
        }

        return $cars;
    }

    public function carCreate(Request $request)
    {
        // Prepare file name path
        $img = $request->file('img');

        $t = time();
        $fileName = $img->getClientOriginalName();
        $imgName = "{$t}-{$fileName}";
        $img_url = "uploads/{$imgName}";

        // Upload File
        $img->move(public_path('uploads'), $imgName);

        return Car::create([
            'name' => $request->input('name'),
            'brand' =>  $request->input('brand'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'car_type' =>  $request->input('car_type'),
            'daily_rent_price' =>  $request->input('daily_rent_price'),
            'image' => $img_url
        ]);
    }

    public function carById(Request $request)
    {
        return Car::where('id', '=', $request->input('id'))->first();
    }

    public function carUpdate(Request $request)
    {
        if ($request->hasFile('img')) {

            // Upload New File
            $img = $request->file('img');

            $t = time();
            $fileName = $img->getClientOriginalName();
            $imgName = "{$t}-{$fileName}";
            $img_url = "uploads/{$imgName}";

            $img->move(public_path('uploads'), $imgName);

            // Delete Old File

            $filePath = $request->input('file_path');

            File::delete($filePath);

            // Update Car
            return Car::where('id', '=', $request->input('id'))
                ->update([
                    'name' => $request->input('name'),
                    'brand' =>  $request->input('brand'),
                    'model' => $request->input('model'),
                    'year' => $request->input('year'),
                    'car_type' =>  $request->input('car_type'),
                    'daily_rent_price' =>  $request->input('daily_rent_price'),
                    'image' => $img_url
                ]);
        } 
        else {
            return Car::where('id', '=', $request->input('id'))
                ->update([
                    'name' => $request->input('name'),
                    'brand' =>  $request->input('brand'),
                    'model' => $request->input('model'),
                    'year' => $request->input('year'),
                    'car_type' =>  $request->input('car_type'),
                    'daily_rent_price' =>  $request->input('daily_rent_price')
                ]);
        }
    }

    public function carDelete(Request $request)
    {

        // Delete file
        $filePath = $request->input('file_path');

        File::delete($filePath);

        return Car::where('id', '=', $request->input('id'))->delete();
    }

    public function carsPage()
    {
        return view('pages.admin.cars-page');
    }
}
