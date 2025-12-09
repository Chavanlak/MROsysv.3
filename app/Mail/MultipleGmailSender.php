<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MultipleGmailSender extends Mailable
{
    use Queueable, SerializesModels;

    public $emailContent;
    public $emailSubject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content, $subject)
    {
        $this->emailContent = $content;
        $this->emailSubject = $subject;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'multiplegmail', // Create this Blade view
            with: [
                'content' => $this->emailContent,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}