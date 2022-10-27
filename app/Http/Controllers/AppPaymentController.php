<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppPaymentRequest;

class AppPaymentController extends Controller
{
    public function index(AppPaymentRequest $request)
    {
        dd($request->all());
    }
}
