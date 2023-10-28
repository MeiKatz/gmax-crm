@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="row">
    <div class="col-md-3">
        @include('app.projectnav')
        <br> <br>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Project Expense</h4>
            </div>
            <div class="card-body">
                <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$prid}}" name="prid">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Record Title</label>
                            <input type="text" class="form-control" name="item" placeholder="Expense Title ">
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
                        
                    <button type="submit" class="btn btn-success btn-block">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
     
     
     

    </div>
    <div class="col-md-9"> 
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Project Expenses</h3>
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
                          <a href="/project/{{ !empty($expense->project) ? $expense->project->id:'' }}">   {{ !empty($expense->project) ? $expense->project->name:'' }} </a>
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
                                      <option value="{{$project->id}}" @if($project->id==$expense->prid) selected @endif>{{$project->name}}</option>
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

        

        
            </div>   
        </div>       
             


        </div>
        
    </div>
    
</div> 



<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )       
        .catch( error => {
            console.error( error );
            
        } );


</script>


@endsection
