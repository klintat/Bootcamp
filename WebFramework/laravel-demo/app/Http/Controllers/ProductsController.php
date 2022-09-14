<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function showProducts()
    {
        $products = Product::all();

        return Inertia::render('Products', [
            "products" => $products,
            "csrf_token" => csrf_token()
        ]);
    }

    public function buy(Request $request)
    {
        $basket = $request->basket;
        $orderId = OrderController::createOrder($basket);

        foreach ($basket as $product) :
            Product::where("id", $product["id"])->update(["stockquantity" => $product["stockquantity"]]);
        endforeach;

        Mail::to(Auth::user())->send(new OrderMail($orderId));
    }
}