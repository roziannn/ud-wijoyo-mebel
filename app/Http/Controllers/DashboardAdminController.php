<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    function index()
    {

        $customers = Customer::all()->count();
        // dd($suctomers);
        return view('admin.dashboard', compact('customers'));
    }
}
