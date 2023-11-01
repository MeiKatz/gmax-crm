<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Invoice;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PayInvoiceController extends Controller {
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Invoice  $invoice
   * @return \Illuminate\Http\Response
   */
  public function __invoke(
    Request $request,
    Invoice $invoice
  ) {
    if ( !$request->hasValidSignature() ) {
      abort( 401 );
    }

    $business = Business::find(1);
    $gateways = PaymentGateway::where('status', 1)->get();
    $invoiceItems = $invoice->items()->paginate(100);
    $payments = $invoice->payments()->paginate(100);

    return view('app.payinvoice')->with([
      'invoice' => $invoice,
      'invoiceItems' => $invoiceItems,
      'payments' => $payments,
      'business' => $business,
      'gateways' => $gateways
    ]);
  }
}
