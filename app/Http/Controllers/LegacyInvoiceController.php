<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use Carbon\Carbon;
use App\Models\InvoiceItem;
use App\Models\PaymentReceipt;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;
use App\Mail\QuoteMail;
use App\Models\Setting;
use App\Models\Project;
use App\Models\Business;
use App\Models\ExpenseManager;
use App\Models\PaymentGateway;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class LegacyInvoiceController extends Controller
{
    public function newinvoicemeta(Request $request)
     {
     }

     public function editinvoicemeta(Request $request)
     {             
          
     }

     public function deleteinvoicemeta(Request $request)
     {       
     }

     public function invoicetaxenable(Request $request)
    {    
        $invoice =Invoice::findOrFail($request->id);       
        $invoice->taxable=$request->taxable;             
        $invoice->save();  
        return redirect()->back()->with('success', ' Tax Info Updated');
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
         $invoices = Invoice::findOrFail($request->invo);
         $invoid =$request->invo;        
         if($invoid!=NULL)
         {
           $meta = $invoices->payments()->find( $payment );
           $getamount = $meta->amount;
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


     public function emailinvoice(Request $request)
     {
      $invoices = Invoice::findOrFail($request->id);      
      Mail::to($invoices->client->email)->send(new InvoiceMail($invoices));
      return redirect()->back()->with('success', 'Mail Sent!');
     }


     public function payinvoice(Request $request)
     {
      
      $invoices = Invoice::findOrFail($request->id);      
      $business = Business::find(1);
      $gateways = PaymentGateway::where('status',1)->get();
      $invoiceItems = $invoices->items()->paginate(100);
      $paymentreceipt = $invoices->payments()->paginate(100);
      return view('app.payinvoice')->with(['invoice'=> $invoices])->with(['invoice_items'=> $invoiceItems])->with(['payments'=> $paymentreceipt])->with(['business'=> $business])->with(['gateways'=> $gateways]);
     }


     /****************************** Quotes ******************************* */

     public function listofquotes(Request $request)
     { 
         $client = Client::all();
         $invoices = QueryBuilder::for(Invoice::class)
        ->allowedFilters(['title','userid','quoteid','quotestat'])
        ->where('type',1)->orderBy('id','desc')->paginate(15);
        // $invoices = Invoice::orderby('id','desc')->where('type',1)->paginate(15);
         return view('quotes.index')->with(['invoices' =>$invoices])->with(['clients'=> $client]);
     }
 
     public function createnewquotes(Request $request)
     {       
         $invoices = Invoice::orderby('id','desc')->where('type',1)->first();  
         $invoice =new Invoice();
         $invoice->type=1;
         $invoice->title =$request->title;
         $invoice->userid =$request->userid;
         $invoice->adminid = Auth::id();  
         if(Invoice::where('type',1)->count()==0){
         $invoice->quoteid =1; }
         else{
             $invoice->quoteid =$invoices->quoteid+1; 
         }
         $invoice->totalamount =0;       
         $invoice->paidamount = 0;     
         $invoice->quotestat = 1;             
         $invoice->save();        
         $lastid = $invoice->id;
        return redirect('/quote/edit/'.$lastid);
     }
 
     public function editquote(Request $request)
     {
      $invoices = Invoice::findOrFail($request->id);      
      $invoiceItems = $invoices->items()->paginate(100);
      $paymentreceipt = $invoices->payments()->paginate(100);
      return view('quotes.edit')->with(['invoice'=> $invoices])->with(['invoice_items'=> $invoiceItems])->with(['payments'=> $paymentreceipt]);
     }

     
     public function emailquote(Request $request)
     {
      $invoices = Invoice::findOrFail($request->id);      
      Mail::to($invoices->client->email)->send(new QuoteMail($invoices));
      return redirect()->back()->with('success', 'Mail Sent!');
     }

     public function viewquote(Request $request)
     {
      
      $invoices = Invoice::findOrFail($request->id);      
      $business = Business::find(1);
      $invoiceItems = $invoices->items()->paginate(100);
      $paymentreceipt = $invoices->payments()->paginate(100);
      return view('quotes.show')->with(['invoice'=> $invoices])->with(['invoice_items'=> $invoiceItems])->with(['payments'=> $paymentreceipt])->with(['business'=> $business]);
     }

     public function viewquotepublic(Request $request)
     {
      
      $invoices = Invoice::findOrFail($request->id);      
      $business = Business::find(1);
      $invoiceItems = $invoices->items()->paginate(100);
      $paymentreceipt = $invoices->payments()->paginate(100);
      return view('quotes.show-public')->with(['invoice'=> $invoices])->with(['invoice_items'=> $invoiceItems])->with(['payments'=> $paymentreceipt])->with(['business'=> $business]);
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
 

     public function cashbooklist(Request $request)
     { 
         $projects = Project::all();


         $expenses = QueryBuilder::for(ExpenseManager::class)
         ->allowedFilters(['date',])
         ->orderBy('id','desc')->get();   

         $paymentreceipt = QueryBuilder::for(PaymentReceipt::class)
         ->allowedFilters(['date'])
         ->orderBy('id','desc')->get();   

       return view('app.cashbook')->with(['expenses' =>$expenses])->with(['recepits' =>$paymentreceipt])->with(['projects'=> $projects]);
     }



     /**************file manager*********** */
     public function filemanager(Request $request)
     {   
         return view('app.filemanager');     
     }


     /************ recorring invoice ************/

     public function createrecorringinvoice(Request $request)
     {       
         $invoices = Invoice::where('type',2)->orderby('id','desc')->first();  
         $invoice =new Invoice();
         $invoice->type=2;
         $invoice->title =$request->title;
         $invoice->userid =$request->userid;
         $invoice->adminid = Auth::id();  
         if(Invoice::where('type',2)->count()==0){
         $invoice->invoid =1; }
         else{
             $invoice->invoid =$invoices->invoid+1; 
         }         
         $invoice->totalamount =0;       
         $invoice->paidamount = 0;     
         $invoice->markAsUnpaid();
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

     // run this as cron once everyday to create recorring invoices


     public function recorringinvoicecron(Request $request)
     {  
        $todaydate = date('Y-m-d');

        echo "Gmax CRM Daily Cron job 🚀 <br>";

        //create a loop here and check any pending invoice
        $reccur = Invoice::recurring()->whereDate('recorringnextdate',$todaydate)->get();

        foreach($reccur as $rcinvo)
        {   
            echo "New Invoice Created <br>";   
            $invoices = Invoice::where('type',2)->orderby('id','desc')->first();  
            $invoice =new Invoice();
            $invoice->type=2;
            $invoice->title =$rcinvo->title;
            $invoice->userid =$rcinvo->userid;
            $invoice->adminid = $rcinvo->adminid;  
            if(Invoice::where('type',2)->count()==0){
            $invoice->invoid =1; }
            else{
                $invoice->invoid =$invoices->invoid+1; 
            }         
            $invoice->totalamount =0;       
            $invoice->paidamount = 0;     
            $invoice->markAsUnpaid();
            $invoice->project_id = $rcinvo->project_id;

            $invoice->recorring = 1;     
            $invoice->recorringtype = $rcinvo->recorringtype; 
            
            $getinvocedate = new Carbon($todaydate);

            if($rcinvo->recorringtype==1) //daily
            {           
                $invoice->recorringnextdate = $getinvocedate->addDay(); 
            }
            if($rcinvo->recorringtype==2) //weekly
            {
                $invoice->recorringnextdate = $getinvocedate->addWeek(); 
            } 
            if($rcinvo->recorringtype==3) //monthly
            {
                $invoice->recorringnextdate =$getinvocedate->addMonth(); 
            }
            if($rcinvo->recorringtype==4) //yearly
            {
                $invoice->recorringnextdate = $getinvocedate->addYear(); 
            }                       

            $invoice->save();   
                 
            echo "New Invoice Saved <br>";   
            // adding metas into it
            $invoiceItems = InvoiceItem::where('invoice_id',$rcinvo->id)->get();
            foreach($invoiceItems as $recrmeta)
            { 
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


}
