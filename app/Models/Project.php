<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Project extends Model
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
     * @return BelongsToMany
     */
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->using(InvoiceProject::class);
    }
}
