<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Verify Your Email Address')
            ->greeting('Hello ' . $notifiable->full_names . '!')
            ->line('Please click the button below to verify your email address and complete your registration.')
            ->action('Verify Email Address', route('verification.verify', ['id' => $notifiable->id, 'hash' => sha1($notifiable->getEmailForVerification())]))
            ->line('If you did not create an account, you can safely ignore this email.')
            ->salutation('Thank you for using our application!');
    }
}
