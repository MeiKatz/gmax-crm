<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\invoice;

class QuoteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invoice;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(invoice $invoice)
    {
        $this->invoice = $invoice; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.quotemail')->subject('Here is Your Quote');
    }
}
