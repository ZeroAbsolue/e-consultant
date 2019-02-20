<?php

namespace App\Mail\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccuseReception extends Mailable
{
    use Queueable, SerializesModels;

    public $receiver;
    public $message;
    public $object;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($receiver,$object,$message)
    {
        $this->receiver = $receiver;
        $this->object = $object;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('app.email'))
                    ->subject('Accusé de reception')
                    ->markdown('Emails.Contact.new');
    }
}
