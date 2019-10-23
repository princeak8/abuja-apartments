<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Contact_message;

class ContactMsg extends Mailable
{
    use Queueable, SerializesModels;

    public $contactmsg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(Contact_message $contactmsg)
    {
        $this->contactmsg = $contactmsg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from('contact@zizix6.com')
                        ->view('emails.contact')
                        ->subject("Abuja Apartments Contact Message");
    }
}
