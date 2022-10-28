<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\MerchantPayment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    /**
     * @param  PaymentRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function index(PaymentRequest $request)
    {
        $sortedRequest = $request->only([
            'merchant_id',
            'payment_id',
            'status', 'amount',
            'amount_paid',
            'currency',
        ]);

        ksort($sortedRequest);

        array_walk($sortedRequest, function (&$value, $key) {
            $value = "{$key}:{$value}";
        });

        $sign = hash('sha256', implode('', $sortedRequest) . $request->merchant_key);

        $lastPayment = MerchantPayment::wherePaymentId($request->payment_id)->first();

        if ($lastPayment && $lastPayment->status->value !== $request->status) {
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

    /**
     * @return Application|Response|ResponseFactory
     */
    public function callback()
    {
        return \response('ok');
    }
}
