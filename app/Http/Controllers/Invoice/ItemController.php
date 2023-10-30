<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller {
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Invoice $invoice
    ) {
        $invoice->items()->create([
            'quantity' => $request->quantity,
            'qtykey' => $request->qtykey,
            'meta' => $request->meta,
            'amount_per_item' => $request->amount,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        InvoiceItem $invoiceItem
    ) {
        $invoiceItem->update([
            'quantity' => $request->quantity,
            'qtykey' => $request->qtykey,
            'meta' => $request->meta,
            'amount_per_item' => $request->amount,
        ]);

        return redirect()->back()->with([
            'success' => 'Invoice item updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceItem  $invoiceItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        InvoiceItem $invoiceItem
    ) {
        $invoiceItem->delete();

        return redirect()->back()->with([
            'success' => 'Invoice item deleted',
        ]);
    }
}
