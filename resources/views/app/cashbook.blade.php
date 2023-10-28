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
              <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path><path d="M12 3v3m0 12v3"></path></svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
               123
              </div>
              <div class="text-muted">
               Today Expenses
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
              <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="6" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                123
              </div>
              <div class="text-muted">
            This Month Expenses
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
              <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z"></path></svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
              123
              </div>
              <div class="text-muted">
              Last Month Expenses
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
              <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path></svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
               123
              </div>
              <div class="text-muted">
              This Year Expenses
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
      <h3 class="card-title">Cashbook</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
    
      </div> 
    </div>
      <div id="advancedsearch" style="display:none;">
        <form action="{{ route('expenses.index') }}" method="get">
          <div class="row" style=" margin:10px;">				
            <div class="col-md-2">					
                <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
                <input type="text" class="form-control form-control-sm" name="filter[title]" placeholder="expense Title">					 
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">expense #id</label>
              <input type="text" class="form-control form-control-sm" name="filter[invoid]" placeholder="eg: 22">					 
          </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Project</label>
              <select class="form-select  form-select-sm" name="filter[userid]">
               
                <option value="">Select Project</option>
                   @foreach($projects as $project)        
                    <option value="{{$project->id}}">{{$project->name}}</option>
                   @endforeach
                  </select>
                </select>					 
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
               <th>Bill Date </th>
                <th>Item </th>
                <th>Project </th>
                <th>Type </th>
                <th>Expense </th>
                <th>Income </th>               
               
                <th>Bill</th>
       
         
          
            </tr>
        </thead>
        <tbody>
          
            @foreach($expenses as $expense)
            <tr>
               
              <td> {{$expense->date}}
              </td>
                <td> {{$expense->item}}</td>
                <td> 
                  <a href="/project/{{ !empty($expense->project) ? $expense->project->id:'' }}">   {{ !empty($expense->project) ? $expense->project->name:'' }} </a>
                </td>
                <td>
                  <span class="badge bg-yellow">Expense</span>
              </td>
                <td>
                    {{$expense->amount}}
                </td>
                <td>
                  
                </td>
               
                <td> {{$expense->bill}}
                </td>
              
                             
                
            </tr>
           @endforeach

           @foreach($recepits as $recepit)
            <tr>
               
              <td> {{$expense->date}}
              </td>
                <td> {{$recepit->item}}</td>
                <td> 
                  <a href="/project/{{ !empty($expense->project) ? $expense->project->id:'' }}">   {{ !empty($expense->project) ? $expense->project->name:'' }} </a>
                </td>
                <td>
                  <span class="badge bg-lime">Income</span>
              </td>
                <td>
                   
                </td>
                <td>
                  {{$recepit->amount}}
                </td>
               
                <td> {{$recepit->bill}}
                </td>
              
                             
                
            </tr>
           @endforeach


        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$expenses->count()}} entries</p>
      
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New expense</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Record Title</label>
                <input type="text" class="form-control" name="item" placeholder="Expense Title ">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Project <small > (Optional) </small></label>
                <select name="project_id" id="select-users" class="form-select">
                  <option value="">Select Project</option>
                   @foreach($projects as $project)        
                    <option value="{{$project->id}}">{{$project->name}}</option>
                   @endforeach
                  </select>
            </div>
            <div class="mb-2">
                <label class="form-label">Amount</label>
                <input type="text" class="form-control" name="amount" placeholder="Amount">
            </div>
            <div class="mb-2">
                <label class="form-label">Bill Date</label>
                <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" placeholder="expense Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Upload Bill</label>
                <input type="file" class="form-control" name="bill" placeholder="expense Title Here">
            </div>
            
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Add Expense</button>
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
