<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RentalController extends Controller
{
    public function rentalList()
    {
        return Rental::with(['user', 'car'])->get();
    }

    public function rentalCreate(Request $request)
    {
        DB::beginTransaction();

        try {

            $user_id = $request->input('user_id');
            $car_id = $request->input('car_id');
            $start_date = date('Y-m-d', strtotime($request->startDate));
            $end_date = date('Y-m-d', strtotime($request->endDate));



            // Check dates validity
            $t = time();
            $date = date('Y-m-d', $t);

            if ($date > $start_date || $start_date > $end_date) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid dates'
                ]);
            }



            // Check booking slots availability
            $bookings = Rental::where('car_id', '=', $car_id)
                ->where('status', '!=', 'Canceled')
                ->select('start_date', 'end_date')
                ->get();

            foreach ($bookings as $booking) {

                if (($start_date >= $booking->start_date) && ($start_date <= $booking->end_date)) {
                    return 0;
                } 
                else if (($end_date >= $booking->start_date) && ($end_date <= $booking->end_date)) {
                    return 0;
                } 
                else if (($booking->start_date >= $start_date) && ($booking->start_date <= $end_date)) {
                    return 0;
                } 
                else if (($booking->end_date >= $start_date) && ($booking->end_date <= $end_date)) {
                    return 0;
                }
            }



            // Total Rent Calculation
            $carRent = Car::where('id', '=', $car_id)->select('daily_rent_price')->first();

            $days = 1;

            if ($start_date !==  $end_date) {
                $days = abs((strtotime($end_date) - strtotime($start_date)) / (24 * 60 * 60)) + 1; // 1 day = 24*60*60 seconds
            }

            $total_cost = $days * $carRent->daily_rent_price;



            // Car status update for instant rent
            $status = 'Pending';

            if ($date === $start_date) {

                $status = 'Ongoing';

                // Update car status to unavailable
                Car::where('id', '=', $car_id)->update([
                    'availability' => 0
                ]);
            }



            Rental::create([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost,
                'status' => $status
            ]);

            DB::commit();

            return 1;
        } 
        catch (Exception $e) {

            DB::rollBack();
            return 0;
        }
    }

    public function rentalById(Request $request)
    {
        return Rental::where('id', '=', $request->id)->first();
    }

    public function rentalUpdate(Request $request)
    {
        DB::beginTransaction();

        try {

            $rental_id = $request->input('id');
            $user_id = $request->input('user_id');
            $car_id = $request->input('car_id');
            $start_date = date('Y-m-d', strtotime($request->startDate));
            $end_date = date('Y-m-d', strtotime($request->endDate));
            $status = $request->input('status');



            // Check booking slots availability
            $bookings = Rental::where('car_id', '=', $car_id)
                ->where('status', '!=', 'Canceled')
                ->where('id',  '!=', $rental_id)
                ->select('start_date', 'end_date')
                ->get();



            foreach ($bookings as $booking) {

                if (($start_date >= $booking->start_date) && ($start_date <= $booking->end_date)) {
                    return 0;
                } 
                else if (($end_date >= $booking->start_date) && ($end_date <= $booking->end_date)) {
                    return 0;
                } 
                else if (($booking->start_date >= $start_date) && ($booking->start_date <= $end_date)) {
                    return 0;
                } 
                else if (($booking->end_date >= $start_date) && ($booking->end_date <= $end_date)) {
                    return 0;
                }
            }

           

            // Total Rent Calculation
            $carRent = Car::where('id', '=', $car_id)->select('daily_rent_price')->first();

            $days = 1;

            if ($start_date !==  $end_date) {
                $days = abs((strtotime($end_date) - strtotime($start_date)) / (24 * 60 * 60)) + 1; // 1 day = 24*60*60 seconds
            }

            $total_cost = $days * $carRent->daily_rent_price;



            // Car status update
            if ($status === 'Ongoing') {

                Car::where('id', '=', $car_id)->update([
                    'availability' => 0
                ]);
            }
            else{
                Car::where('id', '=', $car_id)->update([
                    'availability' => 1
                ]);
            }



            Rental::where('id', '=', $rental_id)->update([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost,
                'status' => $status
            ]);

            DB::commit();

            return 1;
        } 
        catch (Exception $e) {

            DB::rollBack();
            return 0;
        }
    }

    public function rentalDelete(Request $request)
    {
        return Rental::where('id', '=', $request->input('id'))->delete();
    }
}
