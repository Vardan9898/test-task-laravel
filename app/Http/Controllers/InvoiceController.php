<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\InvoiceProject;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class InvoiceController extends Controller
{
    /**
     * @param  InvoiceRequest  $request
     * @return Application|ResponseFactory|Response
     */
    public function index(InvoiceRequest $request)
    {
        $sortedRequest = $request->only([
            'project',
            'invoice',
            'status',
            'amount',
            'amount_paid',
            'rand',
        ]);

        ksort($sortedRequest);

        array_walk($sortedRequest, function (&$value, $key) {
            $value = "{$key}.{$value}";
        });

        $sign = hash('md5', implode('', $sortedRequest) . $request->app_key);

        $lastInvoice = InvoiceProject::whereInvoiceId($request->invoice)->first();

        if ($lastInvoice && $lastInvoice->status->value !== $request->status) {
            Http::withHeaders(['Authorization' => $sign])->post(url('callback'), [
                'project'     => $request->project,
                'invoice'     => $request->invoice,
                'status'      => $request->status,
                'amount'      => $request->amount,
                'amount_paid' => $request->amount_paid,
                'rand'        => $request->rand,
            ]);
        }

        return response('ok');
    }
}
