<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\MerchantPayment;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(PaymentRequest $request)
    {
        $sortedRequest = $request->only(['merchant_id', 'payment_id', 'status', 'amount', 'amount_paid', 'currency']);

        ksort($sortedRequest);

        array_walk($sortedRequest, function (&$value, $key) {
            $value = "{$key}:{$value}";
        });

        $sign = hash('sha256', implode('', $sortedRequest) . $request->merchant_key);

        $lastPaymentStatus = MerchantPayment::wherePaymentId($request->payment_id)->first()->status->value;

        if ($lastPaymentStatus !== $request->status) {
            Http::post(url('callback'), [
                'merchant_id' => $request->merchant_id,
                'payment_id'  => $request->payment_id,
                'status'      => $request->status,
                'amount'      => $request->amount,
                'amount_id'   => $request->amount_paid,
                'timestamp'   => $request->timestamp,
                'sign'        => $sign,
            ]);
        }

        return response('ok');
    }

    public function callback()
    {
        dd('here');
    }
}
