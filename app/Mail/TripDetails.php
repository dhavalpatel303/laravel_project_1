<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TripDetails extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    
    {
          $name = 'Trip Details';
         $address = config("mail.from.address");
          
        return $this->subject('Mail from gudducabs.com')
                    ->view('frontend.emails.tripdetails')
                     ->from($address,$name);
    }
}
