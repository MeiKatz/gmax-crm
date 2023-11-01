<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use Stripe;
use App\Models\PaymentGateway;
use App\Models\Invoice;
use App\Models\PaymentReceipt;
use App\Models\Setting;


use Srmklive\PayPal\Services\ExpressCheckout;


class GatewayController extends Controller
{
    ////////////////////////// razor pay //////////////////////////////

    public function razorpayview()
    {        
        return view('app.payment.razorpay');
    }

    public function razorpaypayment(Request $request)
    {  
        $gateways =PaymentGateway::findOrFail(3);

        $input = $request->all();        
        $api = new Api($gateways->apikey,$gateways->apisecret);
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
                 $invoices = Invoice::findOrFail($request->invoice_id);
                    $paidamountnow = $invoices->totalamount - $invoices->paidamount;
                    $paymentreceipt =new PaymentReceipt();
                    $paymentreceipt->invoice_id=$request->invoice_id;
                    $paymentreceipt->amount =$paidamountnow;
                    $paymentreceipt->date =date('Y-m-d');
                    $paymentreceipt->transation =$input['razorpay_payment_id'];
                    $paymentreceipt->note ='Paid using Razorpay';
                    $paymentreceipt->gateway ='Razorpay';
                    $paymentreceipt->save();
                
                    $currentpaid =  $invoices->paidamount;
                    $invoices->paidamount = $currentpaid + $paidamountnow; 
                    $nowpaid=  $currentpaid + $paidamountnow;           
                    $invoices->markAsPaid();
                    $invoices->save();  

            } 
            catch (\Exception $e) 
            {               
                return redirect()->back()->with('error', $e->getMessage());
            }            
        }
        
 
    return redirect()->back()->with('success', 'Thank you for your payment!');
    }


    //////////////////  stripe //////////////////////

    public function stripeview()
    {
        return view('app.payment.stripe');
    }

    public function stripepayment(Request $request)
    {
        $gateways =PaymentGateway::findOrFail(2);
        $invoices = Invoice::findOrFail($request->invoice_id);
        $setting = Setting::find(1);
        $paidamountnow = $invoices->totalamount - $invoices->paidamount;
        $famount = $paidamountnow*100;
        Stripe\Stripe::setApiKey($gateways->apisecret);
        Stripe\Charge::create ([
                "amount" => $famount,
                "currency" => $setting->suffix,
                "source" => $request->stripeToken,
                "description" => "Payment of Invoice #". $invoices->id,
        ]);
          
        $paymentreceipt =new PaymentReceipt();
        $paymentreceipt->invoice_id=$request->invoice_id;
        $paymentreceipt->amount =$paidamountnow;
        $paymentreceipt->date =date('Y-m-d');
        $paymentreceipt->transation =$request->stripeToken;
        $paymentreceipt->note ='Paid using Stripe';
        $paymentreceipt->gateway ='Stripe';
        $paymentreceipt->save();
      
        $currentpaid =  $invoices->paidamount;
        $invoices->paidamount = $currentpaid + $paidamountnow; 
        $nowpaid=  $currentpaid + $paidamountnow;           
        $invoices->markAsPaid();
        $invoices->save();   

        Session::flash('success', 'Payment Successful !');
           
        return back();
    }

    ////////////////////////////paypal //////////////////////////////

    public function paypalview()
    {
        return view('app.payment.paypal');
    }

    public function paypalhandlePayment(Request $request)
    {
        $oderidd =$request->invoice_id;
        $paymentid =$request->orderID;
       
        if($request->orderID!=NULL)
        {
            $invoices = Invoice::findOrFail($request->invoice_id);
            $paidamountnow = $invoices->totalamount - $invoices->paidamount;
            $paymentreceipt =new PaymentReceipt();
            $paymentreceipt->invoice_id=$request->invoice_id;
            $paymentreceipt->amount =$paidamountnow;
            $paymentreceipt->date =date('Y-m-d');
            $paymentreceipt->transation =$request->orderID;
            $paymentreceipt->note ='Paid using Paypal';
            $paymentreceipt->gateway ='Paypal';
            $paymentreceipt->save();
          
            $currentpaid =  $invoices->paidamount;
            $invoices->paidamount = $currentpaid + $paidamountnow; 
            $nowpaid=  $currentpaid + $paidamountnow;           
            $invoices->markAsPaid();
            $invoices->save();  
          

            
        }
       
       
    }    
    
}
