<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LimiteClientsAtteinte extends Mailable
{
    use Queueable, SerializesModels;

    public $partageur;

    public function __construct($partageur)
    {
        $this->partageur = $partageur;
    }

    public function build()
    {
        return $this->subject('Limite de clients atteinte')
                    ->view('emails.limite_clients');
    }
}

