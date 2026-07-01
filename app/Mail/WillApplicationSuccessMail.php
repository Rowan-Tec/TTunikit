<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WillApplicationSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public $application)
    {
    }

    public function build()
    {
        return $this->subject('Your Will Application Was Successful')
            ->view('emails.will_application')
            ->with([
                'name' => $this->user->name,
                'application' => $this->application,
            ]);
    }
    
}