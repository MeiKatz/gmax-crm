@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="col-12">





     
        <div class="col-12 mb-3">
            <div class="card card-sm">
              <div class="ribbon ribbon-top ribbon-bookmark {{$task->type}}">
                @if($task->status==1)
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-loader" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <line x1="12" y1="6" x2="12" y2="3"></line>
                  <line x1="16.25" y1="7.75" x2="18.4" y2="5.6"></line>
                  <line x1="18" y1="12" x2="21" y2="12"></line>
                  <line x1="16.25" y1="16.25" x2="18.4" y2="18.4"></line>
                  <line x1="12" y1="18" x2="12" y2="21"></line>
                  <line x1="7.75" y1="16.25" x2="5.6" y2="18.4"></line>
                  <line x1="6" y1="12" x2="3" y2="12"></line>
                  <line x1="7.75" y1="7.75" x2="5.6" y2="5.6"></line>
               </svg>
                @else 
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checks" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M7 12l5 5l10 -10"></path>
                  <path d="M2 12l5 5m5 -5l5 -5"></path>
               </svg>
                @endif
              </div>
              <div class="card-body">
                @if($task->status==1) <h3 class="card-title">Project Name - Case ID #{{$task->id}}</h3> @else
                        <s> <h3 class="card-title">Project Name - Case ID #{{$task->id}}</h3> </s> @endif
                <div class="text-muted">{{$task->task}}</div>
                <div class="mt-4">
                  <div class="row">
                    
                    <div class="col">
                      <div class="avatar-list avatar-list-stacked">
                        @if($task->assignedto)                          
                       <span class="avatar  rounded-circle" data-toggle="tooltip" data-placement="bottom" style="background-image: url({{$task->assigned->profile_photo_url}})" title="Assigned to : {{$task->assigned->name}} "></span>                      
                         @endif
                        
                       
                      </div>
                      
                    </div>
                    @if($task->status==1)
                    <div class="col-auto">
                     <a href="/mytasks/view/complete/{{$task->id}}"> <button type="button" class="btn btn-success btn-sm">Mark as Completed</button> </a>
                    </div>
                    @endif
                    <div class="col-auto text-muted">
                      
                        <div class="spinner-grow {{$task->type}}" style="height: 12px; width:12px; padding-top: -15px" role="status"></div>
                 
                    </div>
                    <div class="col-auto">
                      <a href="#" class="link-muted"><!-- Download SVG icon from http://tabler-icons.io/i/message -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4"></path><line x1="8" y1="9" x2="16" y2="9"></line><line x1="8" y1="13" x2="14" y2="13"></line></svg>
                        {{$task->updates->count()}}</a>
                    </div>
                    <div class="col-auto">
                      <form method="post" action="{{ route('projects.tasks.destroy', [ $task->project, $task ]) }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-muted">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="4" y1="7" x2="20" y2="7" />
                            <line x1="10" y1="11" x2="10" y2="17" />
                            <line x1="14" y1="11" x2="14" y2="17" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                          </svg>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Todo List</h3>
                </div>
                <div class="card-body">
          
                  <form action="{{ route('tasks.items.store', [ $task ]) }}" method="post">
                    @csrf
                    <div class="row">
                    <div class="col-md-9">                     
                        <input type="text" class="form-control" name="task" placeholder="Enter Todo" autocomplete="off">
                      </div>                     
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary ms-auto">Add Todo</button>
                  </div>
                </div>
                  </form>
           
                </div>
                <div class="list-group list-group-flush">
                  @foreach($taskItems as $taskItem)
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <form action="{{ route('tasks.items.update', [ $task, $taskItem ]) }}" method="post">
                          @csrf
                          @method('PUT')

                          @if ( $taskItem->status == 0 )
                            <input type="checkbox" name="status" value="1" onchange="this.form.submit()" class="form-check-input" />
                          @else 
                            <input type="checkbox" name="status" value="0" onchange="this.form.submit()" class="form-check-input" checked />
                          @endif
                        </form>
                      </div>                    
                      <div class="col text-truncate">
                        @if($taskItem->status==0)
                        <a class="text-reset d-block">{{$taskItem->task}}</a>
                        @else 
                        <a class="text-reset d-block"><s>{{$taskItem->task}}</s></a>
                        @endif
                 
                        <small class="d-block text-muted text-truncate mt-n1">Added By {{$taskItem->creator->name}} on {{$taskItem->created_at->diffForHumans()}} </small>
                      </div>
                      <div class="col-auto">
                        <form method="post" action="{{ route('tasks.items.destroy', [ $task, $taskItem ]) }}" onsubmit="return confirm('Are you sure?')">
                          @csrf
                          @method('DELETE')

                          <button type="submit" class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <line x1="4" y1="7" x2="20" y2="7" />
                              <line x1="10" y1="11" x2="10" y2="17" />
                              <line x1="14" y1="11" x2="14" y2="17" />
                              <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                              <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                          </button>
                        </form>
                    </div>

                    </div>
                  </div>
                  @endforeach
                  
               
                </div>
              </div>
            </div>
            <div class="col-md-6">

              <div class="card" id="updates">
                <div class="card-header">
                  <h3 class="card-title">Task Comments</h3>
                </div>
                
                <div class="card-body p-2">
                  <form action="{{ route('projects.updates.store', [ $project ] )}}" method="post">
                    @csrf
                    <input type="hidden" name="task_id" value="{{$task->id}}">
<textarea id="editornew" class="form-control" style="width: 100%;" placeholder="Task comments" name="message" rows="3"></textarea>
              
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                      
                      <button type="submit"  class="btn btn-primary ms-auto">Post Comment</button>
                    </div>
                  </div>
                </form>
         

       
                <ul class="list-group card-list-group">
                  @foreach($taskcomments as $update)
                    <li class="list-group-item" >
                      <div class="d-flex">
                        <div>
                          <span class="avatar mr-3" style="background-image: url({{$update->creator->profile_photo_url}}); margin-right: 10px;"></span>
                        </div>
                        <div class="flex-fill">
                          <div>                        
                            <small class=" text-muted" style="float: right;">{{$update->created_at->diffForHumans()}}</small>
                            <h4>{{$update->creator->name}}</h4>
                          </div>
                          <div>                    
                          {!! nl2br(e($update->message)) !!}
                           
                          <form method="post" action="{{ route('projects.updates.destroy', [ $project, $update ]) }}" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="float:right;" class="btn btn-sm btn-warning">Delete</button>
                          </form>
                          <a href="#" class="btn btn-sm" style="margin-right: 5px; float:right;"  data-toggle="modal" data-target="#editupdates{{ $update->id }}">Edit</a>
                      </div>
                       
                      </div>
                    </div>
                  </li>
  
  
                  
  <div class="modal modal-blur fade" id="editupdates{{$update->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Task Comment Update</h5>
          <b type="button" class="close" data-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
           </svg>
          </b>
        </div>
    <form action="{{ route('projects.updates.update', [ $project, $update]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="mb-2">    
  <textarea id="editornew" class="form-control" style="width: 100%;" placeholder="Update Project Status"  name="message" rows="3">{!!$update->message !!}</textarea>
            </div>
            
            
           
        </div>
        <div class="modal-footer">
          <button type="button" class="btn  mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" >Save Changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
                    @endforeach
                  </ul>
                  <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">Showing  {{$taskcomments->count()}} Updates</p>
                    <ul class="pagination m-0 ms-auto">
                      {{$taskcomments->links()}}
                    </ul>
                  </div>
                </div>

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
