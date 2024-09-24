<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        try {
            User::create(
                $request->all()
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Sign Up Successful'
            ], 200);
        } 
        catch (Exception $e) {
            return response()->json([
                'message' => 'Something went wrong !'
            ], 200);
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
                'message' =>  'Login Successful',
                'role' =>  $user->role
            ], 200)->cookie('token',  $token, 60 * 24 * 30);
        } 
        else {
            return response()->json([
                'status'  => 'failed',
                'message' => 'Invalid email or password'
            ],  200);
        }
    }

    public function logout()
    {
        return redirect('/login')->cookie('token', '', -1);
    }

    public function loginPage()
    {
        return view('pages.auth.login-page');
    }

    public function signUpPage()
    {
        return view('pages.auth.sign-up-page');
    }
}
