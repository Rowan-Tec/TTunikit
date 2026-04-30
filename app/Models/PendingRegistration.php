<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PendingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'full_names',
        'surname',
        'email',
        'username',
        'password',
        'cellphone',
        'gender',
        'date_of_birth',
        'expires_at',
    ];

    protected $hidden = [
        'password',
        'token',
        'cellphone',
        'date_of_birth',
        'gender',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /**
     * Generate a unique token for the pending registration
     */
    public static function generateToken(): string
    {
        do {
            $token = Str::random(32);
        } while (self::where('token', $token)->exists());

        return $token;
    }

    /**
     * Create a pending registration with expiration
     */
    public static function createPending(array $data): self
    {
        return self::create([
            'token' => self::generateToken(),
            'full_names' => $data['full_names'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => $data['password'],
            'cellphone' => $data['cellphone'],
            'gender' => $data['gender'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'expires_at' => now()->addHours(24), // Expire after 24 hours
        ]);
    }

    /**
     * Check if the registration has expired
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Clean up expired registrations
     */
    public static function cleanupExpired(): int
    {
        return self::where('expires_at', '<', now())->delete();
    }
}
