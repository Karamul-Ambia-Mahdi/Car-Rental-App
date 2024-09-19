<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function customerList()
    {
        return User::where('role', '=', 'customer')->with('rental')->get();
    }

    public function customerCreate(Request $request)
    {
        return User::create($request->all());
    }

    public function customerById(Request $request)
    {
        return User::where('id', '=', $request->input('id'))
            ->where('role', '=', 'customer')->first();
    }

    public function customerUpdate(Request $request)
    {
        return User::where('id', '=', $request->input('id'))
            ->where('role', '=', 'customer')
            ->update($request->all());
    }

    public function customerDelete(Request $request)
    {
        return User::where('id', '=', $request->input('id'))
            ->where('role', '=', 'customer')->delete();
    }
}
