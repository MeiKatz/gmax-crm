<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ExpenseManager;
use App\Models\Notification;
use App\Models\Invoice;
use App\Models\PaymentReceipt;
use App\Models\Project;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $client = Client::all();

        $data = [];

        for ( $x=0; $x<40; $x++ ) {
          $seldate = Carbon::now()->subDays( $x )->toDateString();
          $invoice = PaymentReceipt::whereDate('created_at', $seldate)->get();
          $count = $invoice->sum('amount');
          $data[ $x ]['count'] = $count;
          $data[ $x ]['date'] = $seldate;
        }

        $quotedata = [];

        for ( $x=0; $x<40; $x++ ) {
          $seldate = Carbon::now()->subDays( $x )->toDateString();
          $expense = ExpenseManager::whereDate('date', $seldate)->get();
          $count = $expense->sum('amount');
          $quotedata[ $x ]['count'] = $count;
          $quotedata[ $x ]['date'] = $seldate;
        }

        $counts = [];

        $invoiceCounts = Invoice::getCounts();

        $counts['unpaid'] = $invoiceCounts['unpaid'];
        $counts['paid']   = $invoiceCounts['paid'];
        $counts['quotes'] = Invoice::where('type',1)->count();
        $counts['prjnotstart'] = Project::where('status',1)->count();
        $counts['prjinprogress'] = Project::where('status',2)->count();
        $counts['prjinreview'] = Project::where('status',3)->count();
        $counts['prjincompleted'] = Project::where('status',5)->count();

        $tasks = Task::where(
            'assignedto',
            Auth::id()
        )->where('status',1)->orderby('id','desc')->get();
        $invoices = Invoice::where(
            'invostatus',
            '1'
        )->orWhere('invostatus','2')->orderby('id','desc')->paginate(3);
        $notifications = Notification::where(
            'status',
            1
        )->where('toid', Auth::id())->orderby('id','desc')->paginate(5);

        return view('dashboard')->with([
            'clients' => $client,
            'counts' => $counts,
            'datas' => $data,
            'invoices' => $invoices,
            'notifications' => $notifications,
            'quotedata' => $quotedata,
            'tasks' => $tasks,
        ]);
    }
}
