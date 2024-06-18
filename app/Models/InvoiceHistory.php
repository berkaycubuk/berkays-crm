<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceHistory extends Model
{
    use HasFactory;

    public $fillable = [
        'invoice_id',
        'action',
        'related_model',
        'related_id',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // TODO: if not null get the related row
}
