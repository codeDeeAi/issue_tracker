<?php

namespace App\Mail;

use App\Models\Buyer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerPasswordResetLink extends Mailable
{
    use Queueable, SerializesModels;
    // Public Variables
    Public $buyer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buyer)
    {
        $this->buyer = $buyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.resetPasswordLink');
    }
}
