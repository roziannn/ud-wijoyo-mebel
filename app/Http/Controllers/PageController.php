<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function aboutUs()
    {
        return view('guest.about-us');
    }

    function contactUs()
    {
        return view('guest.customer-service');
    }
}
