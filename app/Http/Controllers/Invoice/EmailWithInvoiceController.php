<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

class EmailWithInvoiceController extends Controller {
  /**
   * Handle the incoming request.
   *
   * @param  \App\Models\Invoice  $invoice
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Invoice $invoice) {
    Mail::to(
      $invoice->client->email
    )->send(
      new InvoiceMail( $invoice )
    );

    return redirect()->back()->with('success', 'Mail Sent!');
  }
}
