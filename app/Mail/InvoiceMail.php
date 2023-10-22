<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\invoice;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
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
        return $this->markdown('emails.invoicemail')->subject('Here is Your Invoice');
    }
}
