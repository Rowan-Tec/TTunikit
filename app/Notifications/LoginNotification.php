<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ipAddress;
    protected $location;
    protected $userAgent;

    /**
     * Create a new notification instance.
     */
    public function __construct($ipAddress = null, $location = null, $userAgent = null)
    {
        $this->ipAddress = $ipAddress;
        $this->location = $location ?? 'Unknown Location';
        $this->userAgent = $userAgent;
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
        $timestamp = now()->format('M d, Y g:i A');

        return (new MailMessage)
            ->subject('New Login to Your Account')
            ->greeting("Hello, {$fullName}")
            ->line('A new login to your account was detected.')
            ->line("**Date & Time:** {$timestamp}")
            ->line("**Location:** {$this->location}")
            ->line("**IP Address:** {$this->ipAddress}")
            ->line('If this wasn\'t you, please secure your account immediately by changing your password.')
            ->action('Review Account Security', url('/profile'))
            ->line('Keep your account safe and never share your password.')
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
            'message' => 'A new login to your account was detected.',
            'ip_address' => $this->ipAddress,
            'location' => $this->location,
            'timestamp' => now(),
        ];
    }
}
