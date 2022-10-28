<?php

namespace App\Models;

use App\Enums\ProjectInvoiceStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $project_id
 * @property int $invoice_id
 * @property string $status
 * @property float $amount
 * @property float $amount_paid
 * @property string $currency
 * @property string $rand
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class InvoiceProject extends Pivot
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
        'status' => ProjectInvoiceStatus::class,
    ];
}
