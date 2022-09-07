<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

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
}