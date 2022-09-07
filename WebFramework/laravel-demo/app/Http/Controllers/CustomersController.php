<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CustomersController extends Controller
{
    public function showCustomers()
    {
        $customers = DB::table("customer")->select()->get();
        // return view('customers', ["customers" => $customers]);

        return Inertia::render('Customers/CustomersDB', [
            "customers" => $customers,
            "csrf_token" => csrf_token()
        ]);
    }

    public function updateCustomer(Request $request)
    {
        $customersChanged = $request->customers;
        foreach ($customersChanged as $customer) :
            DB::table("customer")->where("id", "=", $customer["id"])->update([
                "firstname" => $customer["firstname"],
                "lastname" => $customer["lastname"], "email" => $customer["email"],
                "phone" => $customer["phone"]
            ]);
        endforeach;
    }
}