<?php

namespace App\Listeners;

use App\Notifications\PasswordResetNotification;
use Illuminate\Auth\Events\PasswordReset;

class SendPasswordResetNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        $event->user->notify(new PasswordResetNotification());
    }
}
