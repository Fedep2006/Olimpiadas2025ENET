<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeNewUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('¡Bienvenido a Olimpiadas!')
                    ->view('emails.welcome_new_user')
                    ->with([
                        'user' => $this->user,
                    ]);
    }
}
