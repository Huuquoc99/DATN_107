<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $isUserEmail;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param bool $isUserEmail
     * @return void
     */
    public function __construct($data, $isUserEmail = false)
    {
        $this->data = $data;
        $this->isUserEmail = $isUserEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->isUserEmail) {
            return $this->subject('We received your message')
                        ->view('client.contact.contact')
                        ->with('data', $this->data);
        } else {
            return $this->subject('New Contact Form Submission')
                        ->view('admin.contacts.contact')
                        ->with('data', $this->data);
        }
    }
}
