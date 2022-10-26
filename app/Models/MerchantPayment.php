<?php

namespace App\Models;

use App\Enums\MerchantPaymentStatus;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MerchantPayment extends Pivot
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'status' => MerchantPaymentStatus::class,
    ];
}
