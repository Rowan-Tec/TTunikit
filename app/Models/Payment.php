<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'application_id',
        'method',
        'status',
        'amount',
        'transaction_id',
        'gateway_reference',
        'proof_path',
        'proof_email',
        'paid_at',
    ];


    protected $casts = [
        'paid_at' => 'datetime',
        'amount'  => 'decimal:2',
    ];

    // Belongs to an application
    public function application()
    {
        return $this->belongsTo(WilApplication::class, 'application_id');
    }
}