<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MinutaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Minuta";  
    public $minuta;
    


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($minuta)
    {   
        
        $this->minuta = $minuta;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.minutaCreate');
    }
}
