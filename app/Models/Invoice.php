<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public $fillable = [
        'project_id',
        'contact_id',
        'subtotal',
        'tax_subtotal',
        'currency',
        'status',
        'first_name',
        'last_name',
        'company',
        'address',
        'city',
        'country',
        'postal_code',
        'tax_id',
        'document_path',
    ];

    public function project()
    {
        if ($this->project_id == null) return null;

        return $this->belongsTo(Project::class);
    }

    public function contact()
    {
        if ($this->contact_id == null) return null;

        return $this->belongsTo(Contact::class);
    }

    public function getTotalAttribute()
    {
        return $this->subtotal + $this->tax_subtotal;
    }
}
