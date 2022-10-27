<?php

namespace App\Models;

use App\Enums\ProjectInvoiceStatus;
use Illuminate\Database\Eloquent\Relations\Pivot;

class InvoiceProject extends Pivot
{
    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'status' => ProjectInvoiceStatus::class,
    ];
}
