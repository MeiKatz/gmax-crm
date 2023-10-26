<?php

namespace App\Http\Controllers;

use App\Models\ExpenseManager;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $expenses = QueryBuilder::for(ExpenseManager::class)
            ->allowedFilters(['prid','date','status'])
            ->orderBy('id','desc')->paginate(15);

        $thisday = Carbon::now()->format('Y-m-d');

        $counts = [
            'today' => ExpenseManager::where('date',$thisday)->sum('amount'),
            'thismonth' => ExpenseManager::whereMonth('date',date('m'))->sum('amount'),
            'lastmonth' => ExpenseManager::whereMonth('date', '=', Carbon::now()->subMonth()->month)->sum('amount'),
            'thisyear' => ExpenseManager::whereYear('date', date('Y'))->sum('amount')
        ];

        return view('app.listofexpenses')->with([
            'expenses' => $expenses,
            'projects' => $projects,
            'counts' => $counts,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense = new ExpenseManager([
            ...$request->all(),
            'auth' => Auth::id(),
            'status' => 1,
        ]);

        $bill = $request->bill;

        if ( $bill !== null ) {
            $filename    = time() . '.' . $request->bill->extension();
            $request->bill->move(public_path('storage/uploads/'), $filename);
            $expense->bill = $filename;
        }
        $expense->save();

        return redirect()->back()->with([
            'success' => 'Expense Added',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseManager  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseManager $expense)
    {
        $expense->prid = $request->prid;
        $expense->item = $request->item;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $bill = $request->bill;

        if ( $bill !== null ) {
            $filename    = time() . '.' . $request->bill->extension();
            $request->bill->move(public_path('storage/uploads/'), $filename);
            $expense->bill = $filename;
        }

        $expense->save();

        return redirect()->back()->with([
            'success' => 'Expense Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseManager  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseManager $expense)
    {
        $expense->delete();

        return redirect()->back()->with([
            'success' => 'Expense Deleted',
        ]);
    }
}
