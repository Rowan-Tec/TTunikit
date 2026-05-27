<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerificationCode extends Notification
{
    use Queueable;

    public function __construct(private readonly string $code)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your TT UNIK IT verification code')
            ->greeting('Hello '.$notifiable->first_name)
            ->line('Use this code to verify your email address:')
            ->line($this->code)
            ->line('This code expires in 15 minutes.')
            ->line('If you did not create this account, you can ignore this email.');
    }
}
