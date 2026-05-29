<?php

namespace App\Notifications;

use App\Models\Application;
use App\Models\WilApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(public WilApplication $application) {}

    public function via(object $notifiable): array
    {
        return ['database']; // stores in notifications table
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'title'          => $this->application->title,
            'status'         => $this->application->status,
            'type'           => $this->application->status,
            'message'        => "Your application \"{$this->application->title}\" has been marked as {$this->application->status}.",
            'url'            => route('student.dashboard'),
            'updated_at'     => now()->toDateTimeString(),
        ];
    }
}