<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailMailable extends Mailable
{
    use Queueable, SerializesModels;

    private $emailNumber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailNumber)
    {
        //
        $this->emailNumber = $emailNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailNumber = $this->emailNumber;
        return $this->view('welcome', compact('emailNumber'));
    }
}
