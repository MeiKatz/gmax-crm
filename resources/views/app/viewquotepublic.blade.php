<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
  $image = public_path('storage/uploads/').$business->logo;
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);
$dataUri = 'data:image/' . $type . ';base64,' . base64_encode($data);
  @endphp
    <div class="row">
       
        <div class="col-md-9">
            <div class="card card-lg">
                <div class="card-body"  id="invoice">
                  <div class="row">
                    <div class="col-6">
                        <img src="{{$dataUri}}" width="200">
                   
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
                      <h3>Quote : #{{$invoice->quoteid}}</h1>
                        <address>
                            <strong>  Quote Date:</strong>  {{ $invoice->invodate}}<br>
                              <strong>  Due Date :</strong> {{ $invoice->duedate}}<br>
                                <strong >  Status :</strong>
                                <x-offer-status :offer="$invoice" />
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
                        @if($invoice->taxable==1)
                        <th class="text-end" style="width: 1%">Tax</th>
                        @endif
                        <th class="text-end" style="width: 1%">Total</th>
                      </tr>
                    </thead>
                    @php $totalamt =0;  $invokey =1; $tottax =0; @endphp
                    @foreach($invometas as $invometa)
                    <tr>
                      <td class="text-center">@php echo $invokey; $invokey ++; @endphp </td>
                      <td>
                      
                        <div class="">{{$invometa->meta}}</div>
                      </td>
                      <td class="text-center">
                        {{$invometa->qty}}<small>{{$invometa->qtykey}}</small>
                      </td>
                      @if($invoice->taxable==1)
                      <td class="text-end">{{$settings->prefix}}{{$invometa->amount}}</td>
                      @endif
                      <td class="text-end">{{$settings->prefix}}@php echo $invometa->tax; $tottax +=$invometa->tax;  @endphp </td>
                      <td class="text-end">{{$settings->prefix}}{{$invometa->total}} @php $totalamt +=$invometa->amount*$invometa->qty; @endphp</td>
                    </tr>
              
                    @endforeach
                    <tr>
                      <td colspan="@if($invoice->taxable==1) 5 @else 4 @endif" class="strong text-end"> @if($invoice->taxable==1)Total Before Tax @else Sub Total @endif</td>
                      <td class="text-end">{{$settings->prefix}}{{$totalamt}}</td>
                    </tr>
                    @if($invoice->taxable==1)
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
                      <td colspan="@if($invoice->taxable==1) 5 @else 4 @endif" class="font-weight-bold text-uppercase text-end">Total Due</td>
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
                      
                        <div class="">{{$payment->method}}</div>
                      </td>
                      <td class="text-center">
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
                  <p class="text-muted text-center mt-5">{{$settings->quotenote}}</p>
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
                   
                    <a class="dropdown-item " href="#"  onclick="printDiv('invoice')">            
                            
                	<svg xmlns="http://www.w3.org/2000/svg"  style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                               Print Quote
                    </a>    
                   
                 
                </div>
                <div class="dropdown-menu dropdown-menu-demo">
                    <span class="dropdown-header">Actions</span>
                
                               
                        <a class="dropdown-item " href="/quote/stat/public/{{$invoice->id}}/2" onclick="return confirm('Are you sure?')">            
                         
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                                      Accept  Quote
                                  </a>  
      
                        <a class="dropdown-item " href="/quote/stat/public/{{$invoice->id}}/3" onclick="return confirm('Are you sure?')">            
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16m2 -2h10a2 2 0 0 1 2 2v10m0 4.01v1.99l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><line x1="11" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="11" y2="11" /><line x1="13" y1="15" x2="15" y2="15" /><line x1="15" y1="11" x2="15" y2="11.01" /><line x1="3" y1="3" x2="21" y2="21" /></svg>
                                Reject Quote
                            </a>    
      
                       
        
        
                </div>
      
            </div>

        </div>
    </div>

      

      
<script>

    const options = {
      margin: 0.5,
      filename: 'invoice{{$invoice->invoid}}.pdf',
      image: { 
        type: 'jpeg', 
        quality: 100
      },
      html2canvas: { 
        scale: 1 
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
