<?php

namespace App\Mail;

use App\Models\Buyer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    // Public Variables
    public $buyer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Buyer $buyer)
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
        return $this->markdown('emails.welcome');
    }
}