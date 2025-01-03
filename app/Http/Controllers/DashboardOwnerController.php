<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardOwnerController extends Controller
{
    function index()
    {
        return view('owner.dashboard');
    }
}
