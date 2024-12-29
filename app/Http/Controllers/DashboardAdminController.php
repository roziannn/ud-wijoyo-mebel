<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    function index()
    {
        return view('admin.dashboard');
    }
}
