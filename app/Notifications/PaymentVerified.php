<?php

namespace App\Notifications;

use App\Models\WilApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PaymentVerified extends Notification
{
    use Queueable;

    public function __construct(public WilApplication $application) {}

    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'title'   => 'Payment Verified',
            'message' => 'Your payment has been verified. Your application will soon be under review.',
            'url'     => route('dashboard'),
            'type'    => 'payment',
        ];
    }
}