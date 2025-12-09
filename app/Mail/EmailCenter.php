<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailCenter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private string $name, private array $attachments =[])
    {
        $this->name = $name;
        $this->attachments = $attachments;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Email Center',
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
            view: 'email',
            with: [
                'name' => $this->name,
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // return [];
        return collect($this->attachments)->map(function($filePath){
            return Attachment::fromPath($filePath);
        })->toArray();
    }
    // public function build()
    // {
    //     $email = $this->view('email')
    //         ->with(['name' => $this->name]);

    //     foreach ($this->attachments as $attachment) {
    //         $email->attach($attachment);
    //     }

    //     return $email;
    // }


}
