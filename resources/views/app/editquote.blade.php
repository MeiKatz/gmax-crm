@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="dropdown-menu dropdown-menu-demo">
                <span class="dropdown-header">Menu</span>
                <a class="dropdown-item " href="/quote/{{ $invoice->id }}">                  
	            <svg xmlns="http://www.w3.org/2000/svg" style="margin-right: 10px;" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                     View Quote
                </a>
             
                <a class="dropdown-item " href="#timeline" data-toggle="modal" data-target="#publiclink"> 
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5" /><line x1="10" y1="14" x2="20" y2="4" /><polyline points="15 4 20 4 20 9" /></svg>
                        Viewable Link
                </a>
                <a class="dropdown-item " href="/quote/email/{{$invoice->id}}">            
                  
            	<svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                            Send Email
                    </a>
               
    
            </div>
            <br> <br>
            <div class="dropdown-menu dropdown-menu-demo">
                <span class="dropdown-header">Actions</span>
           
                <a class="dropdown-item " href="/quote/convert/{{$invoice->id}}" onclick="return confirm('Are you sure?')">            
               
	                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><line x1="9" y1="7" x2="10" y2="7" /><line x1="9" y1="13" x2="15" y2="13" /><line x1="13" y1="17" x2="15" y2="17" /></svg>
                       Convert To Invoice
                    </a>

                    <a class="dropdown-item " href="#timeline" data-toggle="modal" data-target="#editinvoice" >               
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>
                               Edit Quote
                          </a>     
                    <a class="dropdown-item " href="/quote/stat/{{$invoice->id}}/2" onclick="return confirm('Are you sure?')">            
                     
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="margin-right: 10px;" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12l5 5l10 -10" /><path d="M2 12l5 5m5 -5l5 -5" /></svg>
                                  Mark as Approved
                              </a>  

                    <a class="dropdown-item " href="/quote/stat/{{$invoice->id}}/4" onclick="return confirm('Are you sure?')">            
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21v-16m2 -2h10a2 2 0 0 1 2 2v10m0 4.01v1.99l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" /><line x1="11" y1="7" x2="15" y2="7" /><line x1="9" y1="11" x2="11" y2="11" /><line x1="13" y1="15" x2="15" y2="15" /><line x1="15" y1="11" x2="15" y2="11.01" /><line x1="3" y1="3" x2="21" y2="21" /></svg>
                             Cancel Quote
                        </a>
                        <form method="post" action="{{ route('invoices.destroy', [ $invoice ]) }}" onsubmit="return confirm('Are you sure?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"  style="margin-right: 10px;" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <circle cx="12" cy="12" r="9" />
                              <path d="M10 10l4 4m0 -4l-4 4" />
                            </svg>
                            <span>Delete Quote</span>
                          </button>
                        </form>
            </div>


        </div>
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="card-title">Client Information</div>
                        <div class="mb-2">
                
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="7" r="4" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                                          <strong>{{$invoice->client->name}}</strong>
                                        </div>
                                        <div class="mb-2">
                                          
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M16 12v1.5a2.5 2.5 0 0 0 5 0v-1.5a9 9 0 1 0 -5.5 8.28" /></svg>
                                      <strong> {{$invoice->client->email}}</strong>
                                        </div>
                                        <div class="mb-2">
                                   
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /><path d="M15 7a2 2 0 0 1 2 2" /><path d="M15 3a6 6 0 0 1 6 6" /></svg>
                                       <strong> {{$invoice->client->phone}}</strong>
                                        </div>

                       
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="5 12 3 12 12 3 21 12 19 12"></polyline><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                          <strong>  {{$invoice->client->address}} </strong>
                        </div>
                        <div class="mb-2">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="11" r="3"></circle><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path></svg>
                          <strong>
                            {{$invoice->client->city}}, {{$invoice->client->country}}</strong>
                        </div>
                       
                      </div>
                    </div> 
        
                    
                    
                </div>  
                <div class="col-md-6">
                  <div class="card">
                  
                    <div class="card-body">
                    
                      <dl class="row">
                        <dt class="col-5">Title:</dt>
                        <dd class="col-7"><strong>{{$invoice->title}}</strong></dd>
                        <dt class="col-5">Date:</dt>
                        <dd class="col-7">  {{$invoice->invodate}}</dd>
                        <dt class="col-5">Due:</dt>
                        <dd class="col-7">{{$invoice->duedate}}</dd>
                        <dt class="col-5">Quote NO:</dt>
                        <dd class="col-7"><strong>#{{$invoice->quoteid}}</strong></dd>
                    
                        <dt class="col-5">Status:</dt>
                        <dd class="col-7">
                          <x-offer-status :offer="$quote" />
                        </dd>
                        
                        <dt class="col-5">Amount:</dt>
                        <dd class="col-7"><strong>{{$settings->prefix}}{{$invoice->totalamount}}</strong></dd>
                        <dt class="col-5">Balance:</dt>
                        <dd class="col-7"><strong>{{$settings->prefix}}{{$invoice->totalamount - $invoice->paidamount}}</strong></dd>
                        @if($settings->taxstatus==1)
                        <dt class="col-5">Enable Tax:</dt>
                        <dd class="col-7"> 
                          <form action="{{ route('invoices.update', [ $invoice ]) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label class="form-check form-switch m-0">
                            <input class="form-check-input position-static" name="taxable" onchange="this.form.submit()" type="checkbox" @if($invoice->is_taxable) value="0" checked @else value="1" @endif />
                            </label>
                          </form> 
                        </dd>
                        @endif
                      </dl>
                    </div>
                  
                    </div>
        
                   
                </div>  

            </div>
          
            <div class="card" style="margin-top:15px;">
                <div class="card-header">
                  <h3 class="card-title">Quote Items</h3>                
                </div>
                
                
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th style="width:40%">Particular</th>
                                <th>Qty</th>
                                <th>Type</th>
                                <th>amount</th>
                                @if($invoice->is_taxable)
                                <th>tax</th>  
                                @endif                           
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach($invoiceItems as $invoiceItem)
                          @php
                            $formId = 'edit-invoice-item-' . $invoiceItem->id;
                          @endphp
                            <tr>
                                  <td class="text-muted">
                                    <input form="{{ $formId }}" class="form-control form-control-sm" type="text" value="{{$invoiceItem->meta}}" name="meta" placeholder="Particular" />
                                  </td>
                                  <td class="text-muted">
                                    <input form="{{ $formId }}" class="form-control form-control-sm" type="text" name="quantity" value="{{$invoiceItem->quantity}}" placeholder="Qty" />
                                  </td>
                                  <td>
                                      <select form="{{ $formId }}" class="form-control form-control-sm" name="qtykey">
                                        <option value="Qty" @if($invoiceItem->qtykey=="Qty") selected @endif> Qty </option>
                                        <option value="Hour" @if($invoiceItem->qtykey=="Hour") selected @endif> Hour </option>
                                        <option value="Nos" @if($invoiceItem->qtykey=="Nos") selected @endif> Nos </option>
                                      </select>
                                  </td>
                                  <td>                                         
                                    <input form="{{ $formId }}" class="form-control form-control-sm" type="text" name="amount" value="{{$invoiceItem->amount_per_item}}" placeholder="amount" />
                                 </td>
                                 @if($invoice->is_taxable)
                                 <td> 
                                   <input form="{{ $formId }}" class="form-control form-control-sm" type="text" value="{{$settings->prefix}}{{$invoiceItem->tax}}"  placeholder="total" disabled />
                                </td>
                                @endif
                                  <td>
                                    <input form="{{ $formId }}" class="form-control form-control-sm" type="text" value="{{$settings->prefix}}{{$invoiceItem->total}}"  placeholder="total" disabled />
                                 </td>
                                
                                  <td>
                                    <form id="{{ $formId }}" method="post" action="{{ route('invoices.items.update', [ $invoice, $invoiceItem ]) }}">
                                      @csrf
                                      @method('PUT')
                                      <button type="submit" class="btn btn-success btn-sm"style="color: #fff;">Save</button>
                                    </form>
                                  </td>
                                  <td>
                                    <form method="post" action="{{ route('invoices.items.destroy', [ $invoice, $invoiceItem ]) }}" onsubmit="return confirm('Are you sure?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-warning btn-sm" style="color: #fff;">Del</button>
                                    </form>
                                </td>
                              </form>
                          </tr>
                          @endforeach


                            <tr>
                                <form action="{{ route('invoices.items.store', [ $invoice ]) }}" method="post">
                                   @csrf
                                   
                                    <td class="text-muted"> <input class="form-control form-control-sm" type="text"  name="meta"  placeholder="Particular "></td>
                                    <td class="text-muted">
                                      <input class="form-control form-control-sm" type="text" name="quantity" id="qty"  placeholder="Qty">
                                    </td>
                                    <td>
                                        <select class="form-control form-control-sm" name="qtykey">
                                          <option value="Qty"> Qty </option>
                                          <option value="Hour"> Hour </option>
                                          <option value="Nos"> Nos </option>
                                        </select>
                                    </td>
                                    <td>                                         
                                        <input class="form-control form-control-sm" type="text" name="amount" id="amount"  placeholder="amount" onchange="gettotal()">                                          
                                  </td>
                                  @if($invoice->is_taxable)
                                  <td> 
                                    <input class="form-control form-control-sm" type="text"  value="{{$settings->taxpercent}}%"  placeholder="total" disabled>
                                 </td>
                                  @endif
                                <td>                            
                                    <input  id="totalcost" class="form-control form-control-sm" type="text"  value="{{$settings->prefix}}00.00"  placeholder="total" disabled>
                                </td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm"
                                            style="color: #fff;">Save</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                    <script type="text/javascript">
                    function gettotal() {
                         let quantity =  document.getElementById("qty").value;
                         let amount =  document.getElementById("amount").value;
                         let total =  quantity * amount;
                         @if($invoice->is_taxable)
                         let totalamt = {{$settings->taxpercent}} * total / 100 + total;
                         document.getElementById("totalcost").value = "{{$settings->prefix}}"+ totalamt;                         
                          @else                        
                         document.getElementById("totalcost").value = "{{$settings->prefix}}"+ total; 
                          @endif
                        }
                    </script>

                </div>
            </div>


        </div>


    </div>

    <!---- payment mark --->


        <div class="modal modal-blur fade" id="markpayment" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Payment</h5>
                  <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                   </svg>
                  </b>
                </div>
                <form action="{{route('invopaymentsave')}}" method="post">
                    @csrf
                    <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                <div class="modal-body">
                    <div class="mb-2">
                        
                        <input type="date" class="form-control" name="date" placeholder="Date" value="@php  echo date('Y-m-d') @endphp">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$invoice->totalamount - $invoice->paidamount}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="Note">
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Add Payments</button>
                </div>
                </form>
              </div>
            </div>
          </div>

           <!---- refund issue --->


        <div class="modal modal-blur fade" id="issuerefund" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Issue Refund</h5>
                  <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                   </svg>
                  </b>
                </div>
                <form action="{{route('refundinvoice')}}" method="post">
                    @csrf
                    <input type="hidden" name="invoiceid" value="{{$invoice->id}}">
                <div class="modal-body">
                    <div class="mb-2">
                        
                        <input type="date" class="form-control" name="date" placeholder="Date" value="@php  echo date('Y-m-d') @endphp">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Refund Amount</label>
                        <input type="text" class="form-control" name="amount" placeholder="Amount" value="{{$invoice->paidamount}}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Note</label>
                        <input type="text" class="form-control" name="note" placeholder="Note">
                    </div>
                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Issue Refund</button>
                </div>
                </form>
              </div>
            </div>
          </div>


          
          <!---- get payment link --->


        <div class="modal modal-blur fade" id="publiclink" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Get  Link</h5>
                <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                 </svg>
                </b>
              </div>
          
              <div class="modal-body">
                  
                  <div class="mb-2">
                      <label class="form-label">Public Link</label>
                      <input type="text" class="form-control" placeholder="Public link" value="@php echo URL::to('/');@endphp/quote/public/{{$invoice->id}}">
                  </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              
              </div>
              </form>
            </div>
          </div>
        </div>



        <div class="modal modal-blur fade" id="editinvoice" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Update Quote</h5>
                <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                 </svg>
                </b>
              </div>
              <form action="{{ route('invoices.update', [ $invoice ]) }}" method="post">
                  @csrf
                  @method('PUT')
              <div class="modal-body">
                <div class="mb-2">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" value="{{$invoice->title}}" placeholder="Title">
                </div>
                  <div class="mb-2">
                      <label class="form-label">Quote Date</label>
                      <input type="date" class="form-control" name="invodate" placeholder="Invoice Date" value="{{$invoice->invodate}}">
                  </div>
                  <div class="mb-2">
                    <label class="form-label">Due Date</label>
                    <input type="date" class="form-control" name="duedate" placeholder="Due Date" value="{{$invoice->duedate}}">
                  </div>
               
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Update Quote</button>
              </div>
              </form>
            </div>
          </div>
        </div>





@endsection
