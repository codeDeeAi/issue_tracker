<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReportSellerMail extends Mailable
{
    use Queueable, SerializesModels;

     // Public Variables
     Public $reporter;
     Public $details;
     Public $seller;
     Public $saved;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reporter, $details, $seller, $saved)
    {
        $this->reporter = $reporter;
        $this->details = $details;
        $this->seller = $seller;
        $this->saved = $saved;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.sendreportsellermail');
    }
}
