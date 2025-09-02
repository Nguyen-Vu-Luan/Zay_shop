<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifyUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageContent;

    public function __construct($subjectText, $messageContent)
    {
        $this->subjectText = $subjectText;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject($this->subjectText)
            ->view('emails.notify');
    }
}
