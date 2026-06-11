<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallRequest extends Model
{

    protected $fillable = ['name', 'phone', 'status'];

    protected $casts = [
        'called_at' => 'datetime',
    ];

    // Scope to get pending requests
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

}
