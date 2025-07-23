<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    public $greeting;
    public $intro;
    public $content;
    public $type;
    public $actionText;
    public $actionUrl;
    public $outro;
    /**
     * Create a new message instance.
     */
    public function __construct($subject,$intro, $content, $type,$actionText = null, $actionUrl = null, $greeting = null, $outro = null)
    {
        $this->subject = $subject;
        $this->greeting = $greeting;
        $this->intro = $intro;
        $this->content = $content;
        $this->type = $type;
        $this->actionText = $actionText;
        $this->actionUrl = $actionUrl;
        $this->outro = $outro;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.contact',
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
