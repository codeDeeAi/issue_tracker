<?php

namespace App\Mail;

use App\Models\Buyer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerPasswordReset extends Mailable
{
    use Queueable, SerializesModels;
    // Public Variables
    Public $buyer;
    public $initPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buyer, $initPassword)
    {
        $this->buyer = $buyer;
        $this->initPassword = $initPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resetPassword');
    }
}
