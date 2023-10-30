<?php

namespace App\Http\Controllers;

use App\Models\ExpenseManager;
use App\Models\PaymentReceipt;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class CashbookController extends Controller {
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request) {
    $projects = Project::all();

    $expenses = (
      QueryBuilder::for( ExpenseManager::class )
        ->allowedFilters([
          'date',
        ])
        ->orderBy('id', 'desc')
        ->get()
    );

    $payments = (
      QueryBuilder::for( PaymentReceipt::class )
        ->allowedFilters([
          'date',
        ])
        ->orderBy('id', 'desc')
        ->get()
    );

    return view('app.cashbook')->with([
      'expenses' => $expenses,
      'payments' => $payments,
      'projects' => $projects,
    ]);
  }
}
