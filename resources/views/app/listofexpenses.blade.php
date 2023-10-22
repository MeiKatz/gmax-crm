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
              <span class="bg-blue text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                <line x1="16" y1="3" x2="16" y2="7"></line>
                <line x1="8" y1="3" x2="8" y2="7"></line>
                <line x1="4" y1="11" x2="20" y2="11"></line>
                <line x1="11" y1="15" x2="12" y2="15"></line>
                <line x1="12" y1="15" x2="12" y2="18"></line>
             </svg> </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                {{$counts['today']}}
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
              <span class="bg-green text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                <line x1="16" y1="3" x2="16" y2="7"></line>
                <line x1="8" y1="3" x2="8" y2="7"></line>
                <line x1="4" y1="11" x2="20" y2="11"></line>
                <rect x="8" y="15" width="2" height="2"></rect>
             </svg></span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                {{$counts['thismonth']}}
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
              <span class="bg-yellow text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                <line x1="16" y1="3" x2="16" y2="7"></line>
                <line x1="8" y1="3" x2="8" y2="7"></line>
                <line x1="4" y1="11" x2="20" y2="11"></line>
                <line x1="10" y1="16" x2="14" y2="16"></line>
             </svg> </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                {{$counts['lastmonth']}}
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
              <span class="bg-pink text-white avatar"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                <line x1="16" y1="3" x2="16" y2="7"></line>
                <line x1="8" y1="3" x2="8" y2="7"></line>
                <line x1="4" y1="11" x2="20" y2="11"></line>
                <line x1="10" y1="16" x2="14" y2="16"></line>
                <line x1="12" y1="14" x2="12" y2="18"></line>
             </svg></span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                {{$counts['thisyear']}}
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
      <h3 class="card-title">Expense Manager</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New expense</button>
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
                    <option value="{{$project->id}}">{{$project->projectname}}</option>
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
                <th>ID </th>
                <th>Item </th>
                <th>Project </th>
                <th>Amount </th>
                <th>Bill Date </th>
                <th>Bill</th>
       
                <th>Updated</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($expenses as $expense)
            <tr>
               
                <td>
                  
                   # {{$expense->id }}
                </td>
                <td> {{$expense->item}}</td>
                <td> 
                  <a href="/project/{{ !empty($expense->projectdata) ? $expense->projectdata->id:'' }}">   {{ !empty($expense->projectdata) ? $expense->projectdata->projectname:'' }} </a>
                </td>
                <td>
                    {{$expense->amount}}
                </td>
                <td> {{$expense->date}}
                </td>
                <td> {{$expense->bill}}
                </td>
              
              
               
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" data-toggle="modal" data-target="#editexpense{{$expense->id}}" href="#"    >
                                Edit expense
                            </a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure?')"
                                href="/expenses/delete/{{$expense->id}}">
                                Delete expense
                            </a>
                        </div>
                    </span>
                </td>
            </tr>


            


            <div class="modal modal-blur fade" id="editexpense{{$expense->id}}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit expense</h5>
                    <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                     </svg>
                    </b>
                  </div>
              <form action="{{route('expenses.update')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{$expense->id}}">
                  <div class="modal-body">
                      <div class="mb-2">
                          <label class="form-label">Record Title</label>
                          <input type="text" class="form-control" value="{{$expense->item}}" name="item" placeholder="Expense Title ">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Select Project <small > (Optional) </small></label>
                          <select name="prid" id="select-users" class="form-select">
                            <option value="">Select Project</option>
                             @foreach($projects as $project)        
                              <option value="{{$project->id}}" @if($project->id==$expense->prid) selected @endif>{{$project->projectname}}</option>
                             @endforeach
                            </select>
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Amount</label>
                          <input type="text" class="form-control" name="amount" value="{{$expense->amount}}" placeholder="Amount">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Bill Date</label>
                          <input type="date" class="form-control" name="date"  value="{{$expense->date}}">
                      </div>
                      <div class="mb-2">
                          <label class="form-label">Upload New Bill  [{{$expense->bill}}]</label>
                          <input type="file" class="form-control" name="bill" >
                      </div>
                      
                      
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" >Update Expense</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>






           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$expenses->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$expenses->links()}}
      </ul>
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
    <form action="{{route('expenses.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Record Title</label>
                <input type="text" class="form-control" name="item" placeholder="Expense Title ">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Project <small > (Optional) </small></label>
                <select name="prid" id="select-users" class="form-select">
                  <option value="">Select Project</option>
                   @foreach($projects as $project)        
                    <option value="{{$project->id}}">{{$project->projectname}}</option>
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
