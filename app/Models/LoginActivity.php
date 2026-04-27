<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'location',
        'login_time',
        'logout_time',
    ];

    protected function casts(): array
    {
        return [
            'login_time' => 'datetime',
            'logout_time' => 'datetime',
        ];
    }

    /**
     * Get the user that owns this login activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the location string from IP address
     */
    public function getLocationAttribute()
    {
        return $this->attributes['location'] ?? 'Unknown Location';
    }
}
