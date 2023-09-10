<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'amount',
        'description',
        'payment_status',
        'payment_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
