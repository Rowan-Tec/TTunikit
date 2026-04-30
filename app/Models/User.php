<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'full_names',
        'surname',
        'cellphone',
        'gender',
        'date_of_birth',
        'profile_photo',
        'billing_address',
        'role',
        'account_deletion_requested_at',
        'account_deletion_reason',
        'account_deletion_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'account_deletion_requested_at',
        'account_deletion_reason',
        'account_deletion_token',
        'billing_address',
        'cellphone',
        'date_of_birth',
        'gender',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all login activities for this user.
     */
    public function loginActivities()
    {
        return $this->hasMany(LoginActivity::class);
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail());
    }

    /**
     * Mark the email as verified.
     */
    public function markEmailAsVerified()
    {
        $this->email_verified_at = now();
        $this->save();
    }
}
