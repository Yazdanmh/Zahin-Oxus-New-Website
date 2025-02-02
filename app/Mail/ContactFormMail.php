<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $messageContent;

    public function __construct($name, $email, $messageContent)
    {
        $this->name = $name;
        $this->email = $email;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->from('cr.information@dab.gov.af', 'Zahin Oxus') // ✅ Use official domain
                    ->subject('New Contact Form Submission')
                    ->view('emails.contact_form')  // ✅ HTML View
                    ->text('emails.contact_plain'); // ✅ Plain Text View
    }
}
