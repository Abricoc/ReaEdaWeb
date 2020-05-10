<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswords extends Mailable
{
    use Queueable, SerializesModels;

    public $newPassword = '';

    /**
     * Create a new message instance.
     *
     * @param $newPassword
     */
    public function __construct($newPassword)
    {
        $this->newPassword = $newPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.resetPassword', [
            'newPassword' => $this->newPassword
        ]);
    }
}
