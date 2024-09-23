<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homePage()
    {
        return view('pages.home');
    }

    public function aboutPage()
    {
        return view('pages.about');
    }

    public function carsPage()
    {
        return view('pages.cars');
    }

    public function contactPage()
    {
        return view('pages.contact');
    }
}
