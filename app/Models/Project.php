<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->using(InvoiceProject::class);
    }
}
