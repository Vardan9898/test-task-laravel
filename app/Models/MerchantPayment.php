<?php

namespace App\Models;

use App\Enums\MerchantPaymentStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $merchant_id
 * @property int $payment_id
 * @property string $status
 * @property float $amount
 * @property float $amount_paid
 * @property string $currency
 * @property string $sign
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class MerchantPayment extends Pivot
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => MerchantPaymentStatus::class,
    ];
}
