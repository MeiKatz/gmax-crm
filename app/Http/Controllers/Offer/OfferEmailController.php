<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Mail\OfferMail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

class OfferEmailController extends Controller {
  /**
   * Handle the incoming request.
   *
   * @param  \App\Models\Invoice  $offer
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Invoice $offer) {
    Mail::to(
      $offer->client->email
    )->send(
      new OfferMail( $offer )
    );

    return redirect()->back()->with('success', 'Mail Sent!');
  }
}
