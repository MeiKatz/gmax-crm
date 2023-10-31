<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\PaymentReceipt;
use App\Models\Business;
use Spatie\QueryBuilder\QueryBuilder;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $counts = Invoice::getCounts();
        $clients = Client::all();
        $invoices = QueryBuilder::for( Invoice::class )
            ->allowedFilters([
                'title',
                'client_id',
                'invoid',
                'invostatus',
            ])
            ->where('type', 2)
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('app.listofinvoices')->with([
            'invoices' => $invoices,
            'clients' => $clients,
            'counts' => $counts,
        ]);
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

        return view('app.viewinvoice')->with([
            'invoice' => $invoice,
            'invoiceItems' => $invoiceItems,
            'payments' => $payments,
            'business' => $business
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $invoice = DB::transaction(function () {
            $lastInvoice = (
                Invoice::where('type', 2)
                    ->orderby('id', 'desc')
                    ->first()
            );
            $nextInvoiceNumber = (
                $lastInvoice
                    ? $lastInvoice->invoid + 1
                    : 1
            );

            return Invoice::create([
                'type' => 2,
                'title' => $request->title,
                'client_id' => $request->client_id,
                'creator_id' => Auth::id(),
                'project_id' => $request->project_id,
                'invoid' => $nextInvoiceNumber,
            ]);
        });

        return redirect()->route(
            'invoices.edit',
            [ $invoice ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(
        Invoice $invoice
    ) {
        $invoiceItems = $invoices->items()->paginate(100);
        $payments = $invoices->payments()->paginate(100);

        return view('app.editinvoice')->with([
            'invoice' => $invoice,
            'invoiceItems' => $invoiceItems,
            'payments' => $payments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(
        Request $request,
        Invoice $invoice
    ) {
        $invoice->update(
            $request->validated()
        );

        return redirect()->back()->with([
            'success' => 'Invoice updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(
        Invoice $invoice
    ) {
        $invoice->delete();

        return redirect()->route('dashboard')->with([
            'success' => 'Invoice deleted',
        ]);
    }

     public function invopaymentsave(Request $request)
    { 
        if($request->amount!=NULL)
        {
            $paymentreceipt =new PaymentReceipt();
            $paymentreceipt->invoiceid=$request->invoiceid;
            $paymentreceipt->adminid = Auth::id();
            $paymentreceipt->amount =$request->amount;
            $paymentreceipt->date =$request->date;
            $paymentreceipt->transation =$request->transation;
            $paymentreceipt->note =$request->note;
            $paymentreceipt->save();

            $invoices = Invoice::findOrFail($request->invoiceid);
            $currentpaid =  $invoices->paidamount;
            $invoices->paidamount = $currentpaid + $request->amount; 
            $nowpaid=  $currentpaid + $request->amount;
            if($invoices->totalamount==$nowpaid)
            {
                $invoices->markAsPaid();
            }   
            else
            {
                $invoices->markAsPartiallyPaid();
            }                    
            $invoices->save();  

            

            return redirect()->back()->with('success', 'Payment Added');
        }
        else
        {
            return redirect()->back()->with('warning', 'Amount cannot be blank');
        }
        
    }

    public function deletepayment(Request $request)
     {       
         $payment =$request->id;      
         $invoid =$request->invo;        
         if($invoid!=NULL)
         {
           $meta = PaymentReceipt::where('invoiceid',$invoid)->where('id',$payment)->first();
           $getamount = $meta->amount;
           $invoices = Invoice::findOrFail($request->invo); 
           $getpaidamount = $invoices->paidamount;
           $revesedpayment = $getpaidamount - $getamount;
           $invoices->paidamount =$revesedpayment;
           $invoices->save();              
           $meta->delete();
       
         return redirect()->back()->with('success', 'Payment Reversed');
         }
         else
         {
             return redirect()->back()->with('danger', 'Please Try Again');
         }
     }


     public function cancelinvoice(Request $request)
     {
        if($request->id!=NULL)
        {
            $invoices = Invoice::findOrFail($request->id);         
            $invoices->cancel();

            return redirect()->back()->with('success', 'Invoice Cancelled');
        }
        else
        {
            return redirect()->back()->with('danger', 'Please Try Again');
        }
     }


     public function cancelrecurring(Request $request)
     {
        if($request->id!=NULL)
        {
            $invoices = Invoice::findOrFail($request->id);         
            $invoices->recorring =NULL;            
            $invoices->save();  
            return redirect()->back()->with('success', 'Recurring Invoice Cancelled');
        }
        else
        {
            return redirect()->back()->with('danger', 'Please Try Again');
        }
     }

     public function refundinvoice(Request $request)
     {
        if($request->amount!=NULL)
        {
            $paymentreceipt =new PaymentReceipt();
            $paymentreceipt->invoiceid=$request->invoiceid;
            $paymentreceipt->adminid = Auth::id();
            $paymentreceipt->amount =-$request->amount;
            $paymentreceipt->date =$request->date;
            $paymentreceipt->transation =$request->transation;
            $paymentreceipt->note =$request->note;
            $paymentreceipt->save();

            $invoices = Invoice::findOrFail($request->invoiceid);
            $currentpaid =  $invoices->paidamount;
            $invoices->paidamount = $currentpaid - $request->amount; 
            $invoices->markAsRefunded();
            $invoices->save();              

            return redirect()->back()->with('success', 'Refund Issued');
        }
        else
        {
            return redirect()->back()->with('warning', 'Amount cannot be blank');
        }
     }

     public function viewquotepublic(Request $request)
     {
      
      $invoices = Invoice::findOrFail($request->id);      
      $business = Business::find(1);
      $invoiceItems = $invoices->items()->paginate(100);
      $paymentreceipt = $invoices->payments()->paginate(100);
      return view('app.viewquotepublic')->with(['invoice'=> $invoices])->with(['invoice_items'=> $invoiceItems])->with(['payments'=> $paymentreceipt])->with(['business'=> $business]);
     }

     public function quotestatuschange(Request $request)
     {
      $invoices = Invoice::findOrFail($request->id);    
      $invoices->quotestat =$request->stat;             
      $invoices->save();   
      return redirect()->back()->with('success', 'Status Updated!');  
     }
     
     public function quotestatuschangepublic(Request $request)
     {
      if($request->stat==2 || $request->stat==4){
      $invoices = Invoice::findOrFail($request->id);    
      $invoices->quotestat =$request->stat;             
      $invoices->save();   
      return redirect()->back()->with('success', 'Status Updated!');  
      }
      else
      {
        return redirect()->back()->with('warning', 'Error Please Try Again! ');  
      }
     }


     /********* invoice ******* */
     
     
     public function converttoinvo(Request $request)
     {
      $invoicesold = Invoice::orderby('id','desc')->where('type',2)->first();  
      $invoices = Invoice::findOrFail($request->id);    
      if(Invoice::where('type',2)->count()==0){
        $invoices->invoid =1; }
        else{
            $invoices->invoid =$invoicesold->invoid+1; 
        }
      $invoices->markAsUnpaid();
      $invoices->type =2;             
      $invoices->save();   
      return redirect('/invoice/edit/'.$request->id)->with('success', 'Converted as Invoice');  
     }


     /************ recorring invoice ************/

     public function createrecorringinvoice(Request $request)
     {       
         $invoices = Invoice::where('type',2)->orderby('id','desc')->first();  
         $invoice =new Invoice();
         $invoice->type=2;
         $invoice->title =$request->title;
         $invoice->client_id =$request->client_id;
         $invoice->creator_id = Auth::id();
         if(Invoice::where('type',2)->count()==0){
         $invoice->invoid =1; }
         else{
             $invoice->invoid =$invoices->invoid+1; 
         }         

         $invoice->project_id = $request->project_id;
         $invoice->recorring = 1;
         $invoice->recorringtype = $request->recorringtype;
         
         $getinvocedate = new Carbon($request->invodate);
         $invoice->invodate = $request->invodate;       
         $invoice->duedate = $request->invodate;  

         if($request->recorringtype==1) //daily
         {           
             $invoice->recorringnextdate = $getinvocedate->addDay(); 
        }
        if($request->recorringtype==2) //weekly
         {
              $invoice->recorringnextdate = $getinvocedate->addWeek(); 
         } 
        if($request->recorringtype==3) //monthly
         {
             $invoice->recorringnextdate =$getinvocedate->addMonth(); 
         }
        if($request->recorringtype==4) //yearly
         {
             $invoice->recorringnextdate = $getinvocedate->addYear(); 
         }                       
         $invoice->save();        
         $lastid = $invoice->id;
        return redirect('/invoice/edit/'.$lastid);
     }
}
