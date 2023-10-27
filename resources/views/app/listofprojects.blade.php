@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Project Manager</h3>
      <div style="float: right; right:0; margin-right:10px; position: absolute;">
       
      <button type="button"  onclick="advancedsearch()"
      class="btn btn-primary btn-sm">Advanced Search</button>
      <button type="button" data-toggle="modal" data-target="#modal-simple"      
      class="btn btn-success btn-sm">Create New Project</button>
      </div> 
    </div>
      <div id="advancedsearch" style="display:none;">
        <form action="{{ route('listofprojects') }}" method="get">
          <div class="row" style=" margin:10px;">				
            <div class="col-md-2">					
                <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Title</label>
                <input type="text" class="form-control form-control-sm" name="filter[projectname]" placeholder="Invoice Title">					 
            </div>
            
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Client</label>
              <x-select-client
                class="form-select-sm"
                name="filter[client]"
              />
            </div>
            <div class="col-md-2">					
              <label class="form-label" style="margin-bottom: 0px;  padding-left:2px; font-size:13px;">Status</label>
              <select class="form-select  form-select-sm" name="filter[status]">
                <option value="">Select Status</option>
                <option value="1">Not Started</option>
                <option value="2">In Progress</option>
                <option value="3">In Review</option>
                <option value="4">On Hold</option>
                <option value="5">Completed</option>  
                <option value="6">Cancelled</option>          
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
                <th>Title </th>
                <th>Client </th>
                <th>Start Date </th>
                <th>Deadline </th>           
                <th>Staus</th>
                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($projects as $project)
            <tr>
               
                <td>
                  
                   # {{$project->id}}
                </td>
                <td><a href="{{route('viewproject', ['id' => $project->id])}}"> {{$project->projectname}}</a></td>
                <td>
                  <a href="/client/ {{ !empty($project->client) ? $project->client->id:'' }}">   {{ !empty($project->client) ? $project->client->name:'Removed' }} </a>
                 
                </td>
                <td>
                    {{$project->startdate}}
                </td>
                <td> {{$project->deadline}}
                </td>  
              
                <td>
                  <x-project-status :project="$project" />
                </td>
               
                <td class="text-right">
                   
                        <a href="/project/{{$project->id}}" class="btn  btn-sm "
                          >View Project</a>
                       
                  
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$projects->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$projects->links()}}
      </ul>
    </div>
  </div>


  
  <div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create New Project</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{route('createnewproject')}}" method="post">
        @csrf
        <div class="modal-body">
            <div class="mb-2">
                <label class="form-label">Project Title</label>
                <input type="text" class="form-control" name="projectname" placeholder="Project Title Here">
            </div>
            <div class="mb-2">
                <label class="form-label">Select Client <a href="{{route('clients.create')}}" style="float:right;"> Add New Client </a></label>
                <x-select-client
                  name="client"
                  id="select-users"
                />
            </div>
            <div class="mb-2">
                <label class="form-label">Start Date</label>
                <input type="date" value="@php echo date('Y-m-d'); @endphp" class="form-control" name="startdate" placeholder="Start Date">
            </div>
            <div class="mb-2">
                <label class="form-label">DeadLine</label>
                <input type="date" value="@php echo date('Y-m-d'); @endphp" class="form-control" name="deadline" placeholder="DeadLine">
            </div>
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Create Project</button>
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
