<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class OfferController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $clients = Client::all();
    $offers = QueryBuilder::for( Invoice::class )
      ->allowedFilters([
        'title',
        'client_id',
        'quoteid',
        'quotestat',
      ])
      ->where('type', 1)
      ->orderBy('id', 'desc')
      ->paginate(15);

    return view('app.listofquotes')->with([
      'invoices' => $offers,
      'clients' => $clients,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $offer = DB::transaction(function () {
      $nextOfferNumber = $this->getNextOfferNumber();

      return Invoice::create([
        'type' => 1,
        'title' => $request->title,
        'client_id' => $request->client_id,
        'creator_id' => auth()->user()->id,
        'quotestat' => 1,
        'quoteid' => $nextOfferNumber,
      ]);
    });

    return redirect()->route('offers.edit', [ $offer ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Invoice  $invoice
   * @return \Illuminate\Http\Response
   */
  public function show(Invoice $invoice) {
    $business = Business::find(1);
    $invoiceItems = $invoice->items()->paginate(100);
    $payments = $invoice->payments()->paginate(100);

    return view('app.viewquote')->with([
      'business'=> $business,
      'invoice' => $invoice,
      'invoiceItems' => $invoiceItems,
      'payments' => $payments,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Invoice  $invoice
   * @return \Illuminate\Http\Response
   */
  public function edit(Invoice $invoice) {
    $invoiceItems = $invoice->items()->paginate(100);
    $payments = $invoice->payments()->paginate(100);

    return view('app.editquote')->with([
      'invoice' => $invoice,
      'invoiceItems' => $invoiceItems,
      'payments' => $payments,
    ]);
  }

  private function getNextOfferNumber() {
    $lastOffer = (
      Invoice::where('type', 1)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->first()
    );

    return (
      $lastOffer
        ? $lastOffer->invoid + 1
        : 1
    );
  }
}
