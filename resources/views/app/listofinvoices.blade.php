@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="col-12">
  <div class="row row-cards">
    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-red text-white avatar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash-banknote-off" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405"></path>
                  <path d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1"></path>
                  <line x1="18" y1="12" x2="18.01" y2="12"></line>
                  <line x1="6" y1="12" x2="6.01" y2="12"></line>
                  <line x1="3" y1="3" x2="21" y2="21"></line>
               </svg>
              </span>
            </div>
            <div class="col">
              <a href="/invoices?filter%5Binvostatus%5D=1" style="text-decoration: none;"><div class="font-weight-medium">
                {{$counts['unpaid']}}  Unpaid Invoices
              </div>
              </a>
              <div class="text-muted">
             
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-yellow text-white avatar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-dollar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                  <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                  <path d="M12 17v1m0 -8v1"></path>
               </svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                <a href="/invoices?filter%5Binvostatus%5D=2" style="text-decoration: none;">   {{$counts['partpaid']}}  Partpaid Invoices </a>
              </div> 
              <div class="text-muted">
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-green text-white avatar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <circle cx="12" cy="12" r="9"></circle>
                  <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1"></path>
                  <path d="M12 6v2m0 8v2"></path>
               </svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                <a href="/invoices?filter%5Binvostatus%5D=3" style="text-decoration: none;">  {{$counts['paid']}}  Paid Invoices </a>
              </div>
              <div class="text-muted">
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-black text-white avatar">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
               </svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                <a href="/invoices?filter%5Binvostatus%5D=5" style="text-decoration: none;">  {{$counts['canceled']}}  Canceled Invoices </a>
              </div>
              <div class="text-muted">
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card mt-3">
    <div class="card-header">
      <h3 class="card-title">Invoice Manager</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
        <button type="button" data-toggle="modal" data-target="#recurring"      
      class="btn btn-warning btn-sm">Create Recurring Invoice</button>
     
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New Invoice</button>
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      </div> 
    </div>
      <div id="advancedsearch" style="display:none;">
        <form action="{{ route('listofinvoices') }}" method="get">
          <div class="row" style=" margin:10px;">				
            <div class="col-md-2">					
                <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
                <input type="text" class="form-control form-control-sm" name="filter[title]" placeholder="Invoice Title">					 
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Invoice #id</label>
              <input type="text" class="form-control form-control-sm" name="filter[invoid]" placeholder="eg: 22">					 
          </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Client</label>
              <x-select-client
                class="form-select-sm"
                name="filter[userid]"
              />
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Status</label>
              <select class="form-select  form-select-sm" name="filter[invostatus]">
                <option value="">Select Status</option>
                <option value="1">Unpaid</option>
                <option value="2">Part Paid</option>
                <option value="3">Paid</option>
                <option value="4">Refuned</option>
                <option value="5">Cancelled</option>          
                </select>					 
            </div>
           
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">&nbsp;</label>
              <button type="submit" class="btn btn-warning  btn-sm"> Search </button>
            </div>
          </div>
        </form>
        </div>
   

    <div class="table-responsive" id="theTable">
      <table class="table card-table table-vcenter text-nowrap datatable" >
        <thead>
            <tr>
                <th>Invo ID </th>
                <th>Title </th>
                <th>Client </th>
                <th>Date </th>
                <th>Due Date </th>
                <th>Amount</th>
                <th>Paid</th>
                <th>Type</th>
                <th>Staus</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($invoices as $invoice)
            <tr>
               
                <td>
                  
                   # {{$invoice->invoid}}
                </td>
                <td><a href="{{route('invoices.edit', [ $invoice ])}}"> {{$invoice->title}}</a></td>
                <td>
                  @if ( empty( $invoice->clientdata ) )
                  <span>Removed</span>
                  @else
                  <a href="{{ route('clients.show', [ 'client' => $invoice->clientdata->id ]) }}">{{ $invoice->clientdata->name }}</a>
                  @endif
                </td>
                <td>
                    {{$invoice->invodate}}
                </td>
                <td> {{$invoice->duedate}}
                </td>
                <td>{{$settings->prefix}} {{$invoice->totalamount}}
                </td>
                <td>{{$settings->prefix}} {{$invoice->paidamount}}
                </td>
                <td>
                  @if($invoice->recorringtype==NULL)One Time @endif
                  @if($invoice->recorringtype==1)Daily @endif
                  @if($invoice->recorringtype==2)Weekly @endif
                  @if($invoice->recorringtype==3)Monthly @endif
                  @if($invoice->recorringtype==4)Yearly @endif
              </td>  
                <td>
                    @if($invoice->invostatus ==1)<span class="badge bg-yellow">Unpaid</span>@endif
                            @if($invoice->invostatus ==2)<span class="badge bg-indigo">Part Paid</span>@endif
                            @if($invoice->invostatus ==3)<span class="badge bg-green">Paid</span>@endif
                            @if($invoice->invostatus ==4)<span class="badge bg-purple">Refuned</span>@endif
                            @if($invoice->invostatus ==5)<span class="badge bg-dark">Cancelled</span>@endif    
                </td>
               
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/invoice/edit/{{$invoice->id}}">
                                Edit Invoice
                            </a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                href="/invoice/delete/{{$invoice->id}}">
                                Delete Invoice
                            </a>
                        </div>
                    </span>
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$invoices->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$invoices->links()}}
      </ul>
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Invoice</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('createnewinvoice')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Invoice Title</label>
                <input type="text" class="form-control" name="title" placeholder="Invoice Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('clients.create')}}" style="float:right;"> Add New Client </a></label>
                <x-select-client
                  name="userid"
                  id="select-users"
                />
            </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Invoice</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal modal-blur fade" id="recurring" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Recurring Invoice</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('createrecorringinvoice')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Invoice Title</label>
                <input type="text" class="form-control" name="title" placeholder="Invoice Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('clients.create')}}" style="float:right;"> Add New Client </a></label>
                <x-select-client
                  name="userid"
                  id="select-users"
                />
            </div>
            <div class="mb-2">
              <label class="form-label">Invoice Date</label>
              <input type="date" class="form-control" name="invodate" value="{{date('Y-m-d')}}" >
          </div>
            <div class="mb-2">
              <label class="form-label">Recurring Type</label>
              <select name="recorringtype"  class="form-select">                
                  <option value="1">Daily</option>  
                  <option value="2">Weekly</option>
                  <option value="3">Monthly</option>
                  <option value="4">Yearly</option>             
                </select>
          </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Recurring Invoice</button>
        </div>
        </form>
      </div>
    </div>
  </div>
    
	  <script>
      function advancedsearch() {
        var x = document.getElementById("advancedsearch");
        if (x.style.display === "none") {
        x.style.display = "block";
        } else {
        x.style.display = "none";
        }
      }



      </script>

@endsection
