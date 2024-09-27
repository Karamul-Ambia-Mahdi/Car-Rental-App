<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Car;
use App\Models\User;
use App\Models\Rental;
use App\Mail\AdminMail;
use App\Mail\CustomerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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
            $carRent = Car::where('id', '=', $car_id)->first();

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



            // Rental creation
            Rental::create([
                'user_id' => $user_id,
                'car_id' => $car_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_cost' => $total_cost,
                'status' => $status
            ]);

            $user = User::where('id', '=', $user_id)->first();

            // Send Mail to Admin
            Mail::to("mdmahdi45@gmail.com")->send(new AdminMail($carRent->name, $start_date, $end_date, $user->name, $user->email, $user->phone, $user->address));
            // Send Mail to Customer
            Mail::to($user->email)->send(new CustomerMail($carRent->name, $start_date, $end_date, $total_cost, $user->name, $user->address));



            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Rental created successfully'
            ], 200);
        } 
        catch (Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
            ], 200);
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



            // Car status update
            if ($status === 'Ongoing') {

                Car::where('id', '=', $car_id)->update([
                    'availability' => 0
                ]);
            } 
            else {
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

            return response()->json([
                'status' => 'success',
                'message' => 'Rental created successfully'
            ], 200);
        } 
        catch (Exception $e) {

            DB::rollBack();
            return response()->json([
                'status' => 'failed',
                'message' => 'Request failed'
            ], 200);
        }
    }

    public function rentalDelete(Request $request)
    {
        return Rental::where('id', '=', $request->input('id'))->delete();
    }

    public function rentalStatusUpdate(Request $request)
    {
        DB::beginTransaction();

        try {

            $rental_id = $request->input('id');
            $car_id = $request->input('car_id');
            $status = $request->input('status');



            // Car status update
            if ($status === 'Ongoing') {

                Car::where('id', '=', $car_id)->update([
                    'availability' => 0
                ]);
            } 
            else {
                Car::where('id', '=', $car_id)->update([
                    'availability' => 1
                ]);
            }



            // Rental status update
            Rental::where('id', '=', $rental_id)->update([
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

    public function rentalPage()
    {
        return view('pages.admin.rentals-page');
    }
}
