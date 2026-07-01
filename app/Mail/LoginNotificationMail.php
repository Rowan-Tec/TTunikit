<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loginTime;

    public function __construct(public User $user)
    {
        $this->loginTime = now()->format('Y-m-d H:i:s');
    }

    public function build()
    {
        return $this->subject('New Login Detected')
            ->view('emails.login')
            ->with([
                'name' => $this->user->name,
                'time' => $this->loginTime,
            ]);
    }
}