<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

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
     */
    public function toMail(object $notifiable): MailMessage
    {
        $fullName = $notifiable->full_names . ' ' . $notifiable->surname;

        return (new MailMessage)
            ->subject('Password Changed Successfully')
            ->greeting("Hello, {$fullName}")
            ->line('This is to confirm that your password has been successfully changed.')
            ->line('If you did not make this change, please contact our support team immediately.')
            ->action('Go to Account Settings', url('/profile'))
            ->line('Your account security is important to us.')
            ->salutation('Best regards, The TTunikit Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Your password has been successfully changed.',
        ];
    }
}
