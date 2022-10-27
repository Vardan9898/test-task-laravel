<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::post('payment', [PaymentController::class, 'index']);
Route::post('invoice', [InvoiceController::class, 'index']);
Route::post('callback', [PaymentController::class, 'callback'])->name('payment.callback');
