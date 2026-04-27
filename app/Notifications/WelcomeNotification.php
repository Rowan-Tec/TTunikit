<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements ShouldQueue
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
            ->subject('Welcome to TTunikit!')
            ->greeting("Welcome, {$fullName}!")
            ->line('Thank you for creating an account with TTunikit.')
            ->line('We\'re excited to have you on board.')
            ->line('Your account has been successfully created and is ready to use.')
            ->action('Visit Dashboard', url('/dashboard'))
            ->line('If you have any questions, please contact our support team.')
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
            'message' => 'Welcome to TTunikit! Your account has been created.',
        ];
    }
}
