<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request)
    {
        $sortedRequest = $request->only(['merchant_id', 'payment_id', 'status', 'amount', 'amount_paid', 'currency']);

        ksort($sortedRequest);

        array_walk($sortedRequest, function(&$value, $key) {
            $value = "{$key}:{$value}";
        });

        $sign = hash('sha256', implode('', $sortedRequest) . $request->merchant_key);

        $payment = Payment::create();

        $payment->merchants()->attach($request->merchant_id, [
            'status'      => $request->status,
            'amount'      => $request->amount,
            'amount_paid' => $request->amount_paid,
            'currency'    => $request->currency,
            'sign'        => $sign,
        ]);
    }

    public function callback()
    {
        dd('here');
    }
}
