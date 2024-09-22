<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RentalController extends Controller
{
    public function rentalList(Request $request)
    {
        $user_id = $request->header('id');

        return Rental::where('user_id', '=', $user_id)
            ->with(['car'])->get();
    }

    public function rentalCreate(Request $request)
    {
        try {

            $user_id = $request->header('id');

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
                ], 200);
            }



            // Check booking slots availability
            $booking_slot = 0;

            $bookings = Rental::where('car_id', '=', $car_id)
                ->where('status', '!=', 'Canceled')
                ->select('start_date', 'end_date')
                ->get();

            foreach ($bookings as $booking) {

                if (($start_date >= $booking->start_date) && ($start_date <= $booking->end_date)) {
                    $booking_slot = 1;
                } 
                else if (($end_date >= $booking->start_date) && ($end_date <= $booking->end_date)) {
                    $booking_slot = 1;
                } 
                else if (($booking->start_date >= $start_date) && ($booking->start_date <= $end_date)) {
                    $booking_slot = 1;
                } 
                else if (($booking->end_date >= $start_date) && ($booking->end_date <= $end_date)) {
                    $booking_slot = 1;
                }
            }

            if($booking_slot === 1){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Sorry, The car is already booked for this slot'
                ], 200);
            }



            // Total Rent Calculation
            $carRent = Car::where('id', '=', $car_id)->select('daily_rent_price')->first();

            $days = 1;

            if ($start_date !==  $end_date) {
                $days = abs((strtotime($end_date) - strtotime($start_date)) / (24 * 60 * 60)) + 1; // 1 day = 24*60*60 seconds
            }

            $total_cost = $days * $carRent->daily_rent_price;



            // Rental creation
            Rental::create([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Rental created successfully'
            ], 200);
        } 
        catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
            ], 200);
        }
    }

    public function rentalById(Request $request)
    {
        return Rental::where('id', '=', $request->id)
            ->where('user_id', '=', $request->header('id'))
            ->with('car')->first();
    }

    public function rentalUpdate(Request $request)
    {
        try {

            $rental_id = $request->input('id');
            
            $user_id = $request->header('id');

            $car_id = $request->input('car_id');
            $start_date = date('Y-m-d', strtotime($request->startDate));
            $end_date = date('Y-m-d', strtotime($request->endDate));



            // Check status
            $rental = Rental::where('id', '=', $rental_id)
                ->where('user_id', '=', $user_id)
                ->select('status')->first();

            if($rental->status !== 'Pending'){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Sorry, You can not update this rental'
                ], 200);
            }

            
            
            // Check dates validity
            $t = time();
            $date = date('Y-m-d', $t);

            if ($date > $start_date || $start_date > $end_date) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Invalid dates'
                ], 200);
            }



            // Check booking slots availability
            $booking_slot = 0;

            $bookings = Rental::where('car_id', '=', $car_id)
                ->where('status', '!=', 'Canceled')
                ->where('id',  '!=', $rental_id)
                ->select('start_date', 'end_date')
                ->get();

            foreach ($bookings as $booking) {

                if (($start_date >= $booking->start_date) && ($start_date <= $booking->end_date)) {
                    $booking_slot = 1;
                } 
                else if (($end_date >= $booking->start_date) && ($end_date <= $booking->end_date)) {
                    $booking_slot = 1;
                } 
                else if (($booking->start_date >= $start_date) && ($booking->start_date <= $end_date)) {
                    $booking_slot = 1;
                } 
                else if (($booking->end_date >= $start_date) && ($booking->end_date <= $end_date)) {
                    $booking_slot = 1;
                }
            }

            if($booking_slot === 1){
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Sorry, The car is already booked for this slot'
                ], 200);
            }



            // Total Rent Calculation
            $carRent = Car::where('id', '=', $car_id)->select('daily_rent_price')->first();

            $days = 1;

            if ($start_date !==  $end_date) {
                $days = abs((strtotime($end_date) - strtotime($start_date)) / (24 * 60 * 60)) + 1; // 1 day = 24*60*60 seconds
            }

            $total_cost = $days * $carRent->daily_rent_price;



            // Rental update
            Rental::where('user_id', '=', $user_id)
                ->where('id', '=', $rental_id)->update([
                    'user_id' => $user_id,
                    'car_id' => $car_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'total_cost' => $total_cost
                ]);



            return response()->json([
                'status' => 'success',
                'message' => 'Rental updated successfully'
            ], 200);
        } 
        catch (Exception $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
            ], 200);
        }
    }

    public function rentalCancel(Request $request)
    {
        $user_id = $request->header('id');

        $rental_id = $request->input('id');

        $rental = Rental::where('user_id', '=', $user_id)
            ->where('id', '=', $rental_id)->first();

        if($rental->status === 'Pending'){
            
            $rental->update([
                'status' => 'Canceled'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Rental canceled successfully'
            ], 200);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Sorry, You can not cancel this rental'
        ], 200);

    }
}
