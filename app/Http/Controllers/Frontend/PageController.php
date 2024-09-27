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

    public function homePage2()
    {
        return view('pages.frontend.home');
    }

    public function aboutPage2()
    {
        return view('pages.frontend.about');
    }

    public function carsPage2()
    {
        return view('pages.frontend.cars');
    }

    public function contactPage2()
    {
        return view('pages.frontend.contact');
    }

    public function rentalsPage()
    {
        return view('pages.frontend.rentals-page');
    }
}
