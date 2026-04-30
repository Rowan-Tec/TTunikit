<?php

namespace App\Notifications;

use App\Models\PendingRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyRegistrationEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected $pendingRegistration;

    /**
     * Create a new notification instance.
     */
    public function __construct(PendingRegistration $pendingRegistration)
    {
        $this->pendingRegistration = $pendingRegistration;
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
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): \Illuminate\Notifications\Messages\MailMessage
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Verify Your Email Address - Complete Your Registration')
            ->greeting('Hello ' . $this->pendingRegistration->full_names . '!')
            ->line('Thank you for starting your registration. Please click the button below to verify your email address and complete your account creation.')
            ->line('Your account will only be created and saved to our system after you verify your email address.')
            ->action('Verify Email Address', route('registration.verify', ['token' => $this->pendingRegistration->token]))
            ->line('This verification link will expire in 24 hours.')
            ->line('If you did not start this registration, you can safely ignore this email.')
            ->salutation('Thank you for choosing our service!');
    }
}
