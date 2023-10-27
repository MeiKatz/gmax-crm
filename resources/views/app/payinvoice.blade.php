<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ Session::token() }}"> 

        <title>{{$settings->companyname}}</title>

     
        <!-- Styles -->
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <meta name="msapplication-TileColor" content="#206bc4"/>
        <meta name="theme-color" content="#206bc4"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>

        <link rel="icon" href="/front/icon.png" type="image/png"/>
        <link rel="shortcut icon" href="/front/icon.png" type="image/png"/>
        <!-- CSS files -->
        <link href="/dist/css/tabler.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-flags.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-payments.min.css" rel="stylesheet"/>
        <link href="/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
        <link href="/dist/css/demo.min.css" rel="stylesheet"/>

        <script src="/js/jquery.min.js"></script>
         
        <style>
          #hideMe {
            -webkit-animation: cssAnimation 5s forwards; 
            animation: cssAnimation 5s forwards;
            position: fixed;
                    right: 0;
                    margin-top:80px;
        }
        @keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
        @-webkit-keyframes cssAnimation {
            0%   {opacity: 1;}
            90%  {opacity: 1;}
            100% {opacity: 0;}
        }
        .razorpay-payment-button
        {
            background: #3498db;
            background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
            background-image: -moz-linear-gradient(top, #3498db, #2980b9);
            background-image: -ms-linear-gradient(top, #3498db, #2980b9);
            background-image: -o-linear-gradient(top, #3498db, #2980b9);
            background-image: linear-gradient(to bottom, #3498db, #2980b9);
            -webkit-border-radius: 6;
            -moz-border-radius: 6;
            width: 100%;
            border-radius: 6px;
           font-weight: 600;
            color: #ffffff;
            font-size: 14px;
            padding: 8px 20px 8px 20px;
            border: solid #46a1d9 1px;
            text-decoration: none;
        }
        .hide
        {
            display: none;
        }
         </style>


        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
    </head>
    <body class="antialiased">
        <div class="page">

            <body class="font-sans antialiased">
                <div class="min-h-screen bg-gray-100">
                  
                  
                  <div class="content">
                    <div class="container-xl d-flex flex-column justify-content-center">


<script src="/js/jspdf.debug.js"></script>
<script src="/js/html2canvas.min.js"></script>
<script src="/js/html2pdf.min.js"></script>

@php
if($business->logo){ 
$image = public_path('storage/uploads/').$business->logo;
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);
$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
if($business->headerimage){
$headerimage = public_path('storage/uploads/').$business->headerimage;
$headerimagetype = pathinfo($headerimage, PATHINFO_EXTENSION);
$headerimagedata = file_get_contents($headerimage);
$headerimagedataUri = 'data:image/' . $headerimagetype . ';base64,' . base64_encode($headerimagedata);
}
if($business->footerimage){
$footerimage = public_path('storage/uploads/').$business->footerimage;
$footerimagetype = pathinfo($footerimage, PATHINFO_EXTENSION);
$footerimagedata = file_get_contents($footerimage);
$footerimagedataUri = 'data:image/' . $footerimagetype . ';base64,' . base64_encode($footerimagedata);
}
@endphp
  @php $balanceamount =  $invoice->totalamount - $invoice->paidamount @endphp
    <div class="row">
       
        <div class="col-md-9">
            <div class="card card-lg">
                <div class="card-body"  id="invoice">
                  <div class="row">
                    <div class="col-md-12">
                      @if($business->headerimage!=NULL)
                      <img src="{{$headerimagedataUri}}" width="100%">
                      @endif
                    </div>
                    <div class="col-6">
                      @if($business->enablelogo!=1)
                      <img src="{{$dataUri}}" width="200">
                    @endif
                   
                      <address class="mt-2">
                        <strong>{{$business->businessname}}</strong> <br>
                        @if($business->address!=NULL)  {{$business->address}}<br>@endif
                        @if($business->address2!=NULL) {{$business->address2}}<br> @endif
                        @if($business->city!=NULL)   {{$business->city}}, @endif  @if($business->state!=NULL)  {{$business->state}}<br> @endif
                        @if($business->email!=NULL)    {{$business->email}}, @endif  @if($business->contactnum!=NULL)  {{$business->contactnum}}<br> @endif
                        @if($business->taxid!=NULL)   {{$settings->taxname}} : {{$business->taxid}}<br> @endif
          
                      </address>
                    </div>
                    <div class="col-6 text-end">                       
                     
                                                    
                      <address class="mt-4"></address>                    
                        <strong>{{$invoice->client->name}}</strong> <br>
                        {{$invoice->client->business}}<br>
                        {{$invoice->client->address}}<br>
                        {{$invoice->client->state}}, {{$invoice->client->city}}<br>
                        {{$invoice->client->country}}, {{$invoice->client->zip}}<br>
                        {{$invoice->client->email}}
                      </address>
                    </div>
                    <div class="col-12 my-3">
                      <h3>Invoice : #{{$invoice->invoid}}</h1>
                        <address>
                            <strong>  Invoice Date:</strong>  {{ $invoice->invodate}}<br>
                              <strong>  Due Date :</strong> {{ $invoice->duedate}}<br>
                                <strong >  Status :</strong>
                                <x-invoice-status :invoice="$invoice" />
                          </address>
                    </div>
                  </div>
                  <table class="table table-transparent table-responsive">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 1%">#</th>
                        <th>Item</th>
                        <th class="text-center" style="width: 10%">Qnt</th>
                        <th class="text-end" style="width: 1%">Amount</th>
                        @if($invoice->is_taxable)
                        <th class="text-end" style="width: 1%">Tax</th>
                        @endif
                        <th class="text-end" style="width: 1%">Total</th>
                      </tr>
                    </thead>
                    @php $totalamt =0;  $invokey =1; $tottax =0; @endphp
                    @foreach($invoice_items as $invoice_item)
                    <tr>
                      <td class="text-center">@php echo $invokey; $invokey ++; @endphp </td>
                      <td>
                      
                        <div class="">{{$invoice_item->meta}}</div>
                      </td>
                      <td class="text-center">
                        {{$invoice_item->quantity}}<small>{{$invoice_item->qtykey}}</small>
                      </td>
                      @if($invoice->is_taxable)
                      <td class="text-end">{{$settings->prefix}}{{$invoice_item->amount_per_item}}</td>
                      @endif
                      <td class="text-end">{{$settings->prefix}}@php echo $invoice_item->tax; $tottax +=$invoice_item->tax;  @endphp </td>
                      <td class="text-end">{{$settings->prefix}}{{$invoice_item->total}} @php $totalamt +=$invoice_item->total_amount; @endphp</td>
                    </tr>
              
                    @endforeach
                    <tr>
                      <td colspan="@if($invoice->taxable==1) 5 @else 4 @endif" class="strong text-end"> @if($invoice->is_taxable)Total Before Tax @else Sub Total @endif</td>
                      <td class="text-end">{{$settings->prefix}}{{$totalamt}}</td>
                    </tr>
                    @if($invoice->is_taxable)
                    <tr>
                      <td colspan="5" class="strong text-end">{{$settings->taxname}}</td>
                      <td class="text-end">{{$settings->taxpercent}}%</td>
                    </tr>
                    <tr>
                      <td colspan="5" class="strong text-end">{{$settings->taxname}} Due</td>
                      <td class="text-end">{{$settings->prefix}}{{$tottax}}</td>
                    </tr>
                    @endif
                    <tr>
                      <td colspan="@if($invoice->is_taxable) 5 @else 4 @endif" class="font-weight-bold text-uppercase text-end">Total Due</td>
                      <td class="font-weight-bold text-end">{{$settings->prefix}}{{$invoice->totalamount}}</td>
                    </tr>
                  </table>
                  @if($payments->count()>0)
                  <h3 class="mt-4">Transactions </h3>
                  <table class="table table-transparent table-responsive">
                    <thead>
                      <tr>                        
                        <th>Transaction Date</th>
                        <th class="text-center">Gateway</th>
                        <th class="text-end">Transaction ID</th>
                        <th class="text-end" >Amount</th>
                      </tr>
                    </thead>
                    @php $totalpaid = 0; @endphp
                    @foreach($payments as $payment)
                    <tr>
                      <td class="text-left">{{$payment->date}}</td>
                      <td>
                      
                        <div class="text-center">{{$payment->gateway}}</div>
                      </td>
                      <td class="text-end">
                        {{$payment->transation}}  
                      </td>
                      
                      <td class="text-end"> {{$settings->prefix}}{{$payment->amount}}
                        @php $totalpaid += $payment->amount; @endphp</td>
                    </tr>
                   @endforeach
                   
                    <tr>
                      <td colspan="3" class=" font-weight-bold text-end">Total Paid</td>
                      <td class=" text-end">{{$settings->prefix}}{{ $totalpaid}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="font-weight-bold text-uppercase text-end">Balance Due</td>
                        <td class="font-weight-bold text-end">{{$settings->prefix}}@php echo $invoice->totalamount - $invoice->paidamount  @endphp</td>
                      </tr>
                  </table>
                  @endif
                  <p class="text-muted text-center mt-5">{{$settings->invoicenote}}</p>

                  <div class="col-md-12">
                    @if($business->footerimage!=NULL)
                    <img src="{{$footerimagedataUri}}" width="100%">
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
                <div class="dropdown-menu dropdown-menu-demo">
                    <span class="dropdown-header">Menu</span>
                 
                    <a class="dropdown-item btn-download"  href="javascript:void(0)" >            
                    <svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><polyline points="7 11 12 16 17 11" /><line x1="12" y1="4" x2="12" y2="16" /></svg>
                            Download PDF
                    </a>
                   
                    <a class="dropdown-item " href="#timeline"  onclick="printDiv('invoice')">            
                            
                	<svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                               Print Invoice
                    </a>    
                   
                 
                </div>


                @foreach($gateways as $gateway)
                    <div class="card mb-2">
                        <div class="card-body">
                            <h3 class="card-title">{!!$gateway->icon!!} {{$gateway->paytitle}}</h3>
                            @if($gateway->id==1) 
                            <script src="https://www.paypal.com/sdk/js?client-id={{$gateway->apikey}}">
                            </script> 
                            <div id="paypal-button-container"> </div> 
                            
                            </div>
                          </div>
                            @endif
                            @if($gateway->id==2)  
                            
                              <div class="card mb-2">
                            <div class="card-body">
                            <div class="panel-body">
                             
                              
                                <form role="form" action="{{ route('stripepayment') }}" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$gateway->apikey}}" id="payment-form">
                                   @csrf
                                   <input type="hidden" name="invoid" value="{{$invoice->id}}">
                                  <div class="row"> 
                                 <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">Name On Card</label>
                                        <input type="text" class="form-control" name="" value=""  placeholder="Name On Card">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-2">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" class="form-control card-number" name="" value="" placeholder="Card Number">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control card-cvc" name="" value="" placeholder="CVV">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Month</label>                                     
                                        <select class="form-select card-expiry-month">
                                            <option value="">Month</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                           
                                          </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label class="form-label">Year</label>                                    
                                        <select class="form-select card-expiry-year">
                                            <option value="">Year</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                           
                                          </select>
                                    </div>
                                </div>
                                  </div>

                                 
                             
                                    <div class='col-md-12 error form-group hide'>
                                       <div class='alert-danger alert'>Please correct the errors and try
                                          again.
                                       </div>
                                    </div>
                            
                                   <div class="form-row row">
                                      <div class="col-xs-12">
                                         <button class="btn btn-purple w-100" type="submit">Pay Now</button>
                                      </div>
                                   </div>
                                </form>
                             </div>
                            
                            
                            
                            @endif
                            @if($gateway->id==3)   
                            
                       
                        <div class="panel panel-default" style="">
                        
                           
                    
                            
                                <form action="{!!route('razorpaypayment')!!}" method="POST" >                        
                                    <script  src="https://checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{$gateway->apikey}}"
                                            data-amount="{{$balanceamount}}00"
                                            data-buttontext="{{$gateway->paytitle}}"
                                            data-name="{{$business->name}}"                                            
                                            data-description="Payment on Invoice #{{$invoice->id}}"
                                            data-image="/storage/uploads/{{$business->logo}}"
                                            data-prefill.name="{{$invoice->client->name}}"
                                            data-prefill.contact="{{$invoice->client->phone}}"
                                            data-prefill.email="{{$invoice->client->email}}"
                                            data-theme.color="#2b81c2">
                                    </script>
                                    <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                                    <input type="hidden" name="invoid" value="{{$invoice->id}}">
                                </form>
                          
                        </div>
                            
                            @endif
                        </div>
                    </div>

                @endforeach


            </div>

        </div>
    </div>

      
    @livewireScripts
    @if (\Session::has('success'))
    <div id='hideMe'>
      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
        <div class="toast-header">
          <span class="avatar avatar-xs me-2" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
          <strong class="me-auto">System</strong>
          <small>1 sec ago</small>
          <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">            
          <span class="badge bg-green">Success</span>
                   {!! \Session::get('success') !!}
              
        </div>
      </div>
      @endif 
      
      @if (\Session::has('warning'))
    <div id='hideMe'>
      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
        <div class="toast-header">
          <span class="avatar avatar-xs me-2" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
          <strong class="me-auto">System</strong>
          <small>1 sec ago</small>
          <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">            
          <span class="badge bg-yellow">Warning</span>
                   {!! \Session::get('warning') !!}
              
        </div>
      </div>
      @endif 

      @if (\Session::has('danger'))
    <div id='hideMe'>
      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false" data-bs-toggle="toast">
        <div class="toast-header">
          <span class="avatar avatar-xs me-2" >
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /><path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727" /><path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727" /></svg></span>
          <strong class="me-auto">System</strong>
          <small>1 sec ago</small>
          <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">            
          <span class="badge bg-red">Error</span>
                   {!! \Session::get('danger') !!}
              
        </div>
      </div>
      @endif 



<script>

    const options = {
      margin: 0.5,
      filename: 'invoice{{$invoice->invoid}}.pdf',
      image: { 
        type: 'jpeg', 
        quality: 100
      },
      html2canvas: { 
        scale: 4 
      },
      jsPDF: { 
        unit: 'in', 
        format: 'letter', 
        orientation: 'portrait' 
      }
    }
    
    $('.btn-download').click(function(e){
      e.preventDefault();
      const element = document.getElementById('invoice');
      html2pdf().from(element).set(options).save();
    });


    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
    </script>




<script>
paypal.Buttons({
  createOrder: function(data, actions) {
    return actions.order.create({
      purchase_units: [{
        amount: {
         currency_code: '{{$settings->suffix}}',
          value: '{{$balanceamount}}'
        }
      }]
    });
  },
  onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
      window.location = '{{route('payinvoice', ['id' => $invoice->id])}}';
      // Call your server to save the transaction
      return fetch('{{route('paypalhandlePayment')}}', {
        method: 'post',
        headers: {
          'content-type': 'application/json'
        },
        body: JSON.stringify({
          '_token': $('meta[name=csrf-token]').attr('content'),
          orderID: data.orderID,
          invoid: '{{$invoice->id}}',
          amount: data.amount
        })        
            
      });
     
     
    });
  }
}).render('#paypal-button-container');
</script>



<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$(function() {
  var $form = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form = $(".require-validation"),
    inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
    $inputs = $form.find('.required').find(inputSelector),
    $errorMessage = $form.find('div.error'),
    valid = true;
    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
        var $input = $(el);
        if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
        }
    });
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
          number: $('.card-number').val(),
          cvc: $('.card-cvc').val(),
          exp_month: $('.card-expiry-month').val(),
          exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
      if (response.error) {
          $('.error')
              .removeClass('hide')
              .find('.alert')
              .text(response.error.message);
      } else {
          /* token contains id, last4, and card type */
          var token = response['id'];
          $form.find('input[type=text]').empty();
          $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        
          $form.get(0).submit();
      }
  }
});
</script>
