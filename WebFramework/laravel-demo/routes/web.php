<?php

use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Mail\OrderMail;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\Mailer\Exception\TransportException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/products', [ProductsController::class, "showProducts"])
    ->middleware(['auth', 'verified'])->name("products");

Route::get("/customers", [CustomersController::class, "showCustomers"])
    ->middleware(['auth', 'verified'])->name("customers");

Route::post("/customers-update", [CustomersController::class, "updateCustomer"]);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/buy', [ProductsController::class, "buy"]);

Route::get("/order", [OrderController::class, "showOrder"]);

Route::get('/sendOrderEMail/{id}', function ($id) {
    try {
        // $a = 1 / 0;
        throw new DivisionByZeroError("Manually triggered error");
        Mail::to("teberga.klinta@gmail.com")->send(new OrderMail($id));
    } catch (TransportException | DivisionByZeroError $e) {
        return view("error", ["error_text" => $e->getMessage()]);
    }
});

require __DIR__ . '/auth.php';