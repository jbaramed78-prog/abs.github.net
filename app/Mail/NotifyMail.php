<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $firstName;
    public $lastName;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codeVerification,$firstName,$lastName)
    {
        $this->code = $codeVerification;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Réinitialisation du mot de passe du compte Absys Ofppt')
        ->view('Email.template',[
            'code' => $this->code,
            'nom' => $this->firstName,
            'prenom' => $this->lastName,
        ]);
    }
}
