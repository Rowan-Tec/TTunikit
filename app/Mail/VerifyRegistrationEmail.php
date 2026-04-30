<?php

namespace App\Mail;

use App\Models\PendingRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyRegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendingRegistration;

    /**
     * Create a new message instance.
     */
    public function __construct(PendingRegistration $pendingRegistration)
    {
        $this->pendingRegistration = $pendingRegistration;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Your Email Address - Complete Your Registration',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-registration',
            with: [
                'pendingRegistration' => $this->pendingRegistration,
                'verificationUrl' => route('registration.verify', ['token' => $this->pendingRegistration->token]),
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
