<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'company',
        'website',
        'country',
        'city',
        'address',
        'postal_code',
        'tax_id',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
