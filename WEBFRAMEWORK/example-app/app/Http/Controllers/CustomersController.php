<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomersController extends Controller
{
    public function showCustomers()
    {
        $customers = DB::table("customer")->select()->get();
        return view('customers', ["customers" => $customers]);
    }
}