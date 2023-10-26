@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Quotation Manager</h3>

    <div style="float: right; right:0; margin-right:10px; position: absolute;">       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New Quotation</button>
      </div> 
    </div>

    <div id="advancedsearch" style="display:none;">
      <form action="{{ route('listofquotes') }}" method="get">
        <div class="row" style=" margin:10px;">				
          <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
              <input type="text" class="form-control form-control-sm" name="filter[title]" placeholder="Quote Title">					 
          </div>
          <div class="col-md-2">					
            <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Quote #id</label>
            <input type="text" class="form-control form-control-sm" name="filter[quoteid]" placeholder="eg: 22">					 
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
            <select class="form-select  form-select-sm" name="filter[quotestat]">
              <option value="">Select Status</option>
              <option value="1">Pending</option>
              <option value="2">Approved</option>
              <option value="3">Rejected</option>
              <option value="4">Cancelled</option>
              </select>					 
          </div>
         
          <div class="col-md-2">					
            <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">&nbsp;</label>
            <button type="submit" class="btn btn-warning  btn-sm"> Search </button>
          </div>
        </div>
      </form>
      </div>

    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th>Quote ID </th>
                <th>Title </th>
                <th>Client </th>
                <th>Date </th>
                <th>Due Date </th>
                <th>Amount</th>               
                <th>Staus</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($invoices as $invoice)
            <tr>
               
                <td>
                   
                   # {{$invoice->quoteid}}
                </td>
                <td><a href="{{route('editquote', ['id' => $invoice->id])}}"> {{$invoice->title}}</a></td>
                <td>
                  <a href="/client/ {{ !empty($invoice->clientdata) ? $invoice->clientdata->id:'' }}">   {{ !empty($invoice->clientdata) ? $invoice->clientdata->name:'Removed' }} </a>
                </td>
                <td>
                    {{$invoice->invodate}}
                </td>
                <td> {{$invoice->duedate}}
                </td>
                <td>{{$settings->prefix}} {{$invoice->totalamount}}
                </td>
                
                <td>
                    @if($invoice->quotestat ==1)<span class="badge bg-yellow">Pending</span>@endif
                    @if($invoice->quotestat ==2)<span class="badge bg-green">Approved</span>@endif
                    @if($invoice->quotestat ==3)<span class="badge bg-red">Rejected</span>@endif                 
                    @if($invoice->quotestat ==4)<span class="badge bg-dark">Cancelled</span>@endif    
                </td>
               
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/invoice/edit/{{$invoice->id}}">
                                Edit Quote
                            </a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                href="/invoice/delete/{{$invoice->id}}">
                                Delete Quote
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
          <h5 class="modal-title">Create New Quote</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('createnewquotes')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Quote Title</label>
                <input type="text" class="form-control" name="title" placeholder="Quote Title Here">
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
          <button type="submit" class="btn btn-success" >Create Quote</button>
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
