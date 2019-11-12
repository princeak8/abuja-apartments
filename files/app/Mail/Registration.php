<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Realtor;

class Registration extends Mailable
{
    use Queueable, SerializesModels;

    public $realtor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public function __construct(Realtor $realtor)
    {
        $this->realtor = $realtor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from('contact@abujaapartments.com.ng')
                        ->view('emails.new_registration')
                        ->subject("Successfull Abuja Apartments Registration");
    }
}
