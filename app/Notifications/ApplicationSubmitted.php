<?php

namespace App\Notifications;

use App\Models\WilApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationSubmitted extends Notification
{
    use Queueable;

    public function __construct(public WilApplication $application){}

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase($notifiable): array
    {
        return [
            'title'   => 'New WIL Application',
            'message' => $this->application->user->full_names . ' ' . $this->application->user->surname . ' has submitted a WIL application.',
            
            'type'    => 'application',
        ];
    }

}
