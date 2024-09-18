<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            return User::create(
                $request->all()
            );
        } 
        catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->first();

        if ($user !== null) {

            $token = JWTToken::CreateToken($user->email, $user->id);

            return response()->json([
                'status' => 'success',
                'message' =>  'Login Successful'
            ], 200)->cookie('token',  $token, 60 * 24 * 30);
        } 
        else {
            return response()->json([
                'status'  => 'failed',
                'message' => 'Invalid email or password'
            ],  401);
        }
    }

    public function logout()
    {
        return response()->json([
            'status'  => 'success',
            'message' => 'Logged out successfully'
        ],  200)->cookie('token', '', -1);
    }
}
