<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class TrainingApplicationMail extends Mailable
{
    public $name;
    public $email;
    public $organization;
    public $phone;
    public $address;
    public $identity_card_id;
    public $position;
    public $trainingName;

    public function __construct($name, $email, $organization, $phone, $address, $identity_card_id, $position, $trainingName)
    {
        $this->name = $name;
        $this->email = $email;
        $this->organization = $organization;
        $this->phone = $phone;
        $this->address = $address;
        $this->identity_card_id = $identity_card_id;
        $this->position = $position;
        $this->trainingName = $trainingName;
    }

    public function build()
    {
        return $this->from('cr.information@dab.gov.af', 'Zahin Oxus') // Official email
                    ->subject('New Training Application')
                    ->view('emails.training_application')  // HTML View
                    ->text('emails.training_plain'); // Plain Text View
    }
}
