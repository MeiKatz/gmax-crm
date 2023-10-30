<?php

namespace App\Jobs;

use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class CreateRecurringInvoice implements ShouldQueue {
  use Dispatchable;
  use InteractsWithQueue;
  use Queueable;
  use SerializesModels;

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    DB::transaction(function () {
      $this->handleInTransaction();
    });
  }

  private function handleInTransaction() {
    $todaydate = date('Y-m-d');

    echo "Gmax CRM Daily Cron job 🚀 <br>";

    //create a loop here and check any pending invoice
    $reccur = Invoice::recurring()->whereDate('recorringnextdate', $todaydate)->get();
    $lastInvoiceNumber = $this->getLastInvoiceNumber();
    $getinvocedate = new Carbon( $todaydate );

    foreach ( $reccur as $rcinvo ) {
      echo "New Invoice Created <br>";

      $invoice = Invoice::create([
        'type' => 2,
        'title' => $rcinvo->title,
        'userid' => $rcinvo->userid,
        'adminid' => $rcinvo->adminid,
        'invoid' => $lastInvoiceNumber++,
        'project_id' => $rcinvo->project_id,
        'recorring' => 1,
        'recorringtype' => $rcinvo->recorringtype,
      ]);

      switch ( $rcinvo->recorringtype ) {
        // daily
        case 1:
          $invoice->recorringnextdate = $getinvocedate->addDay();
          break;

        // weekly
        case 2:
          $invoice->recorringnextdate = $getinvocedate->addWeek();
          break;

        // monthly
        case 3:
          $invoice->recorringnextdate = $getinvocedate->addMonth();
          break;

        // yearly
        case 4:
          $invoice->recorringnextdate = $getinvocedate->addYear();
          break;
      }

      $invoice->save();

      echo "New Invoice Saved <br>";

      // adding metas into it
      $invoiceItems = Invoice::with('items')->findOrFail( $rcinvo->id )->items;

      foreach ( $invoiceItems as $recrmeta ) {
        echo "New Meta Added <br>";

        $invoiceItem = $invoice->items()->create([
          'quantity' => $recrmeta->quantity,
          'qtykey' => $recrmeta->qtykey,
          'meta' => $recrmeta->meta,
          'amount_per_item' => $recrmeta->amount_per_item,
        ]);
      }

      echo "New Invoice Completed <br>";
    }
  }

  private function getLastInvoiceNumber() {
    $lastInvoice = (
      Invoice::where('type', 2)
        ->orderBy('id', 'desc')
        ->limit(1)
        ->first()
    );

    if ( $lastInvoice ) {
      return $lastInvoice->invoid;
    }

    return 0;
  }
}
