@extends('layouts.app')
@section('title', 'Page Title')

@section('content')

<script type="text/javascript">
  jQuery(function() {
    jQuery('#status').change(function() {
      this.form.submit();
    });
  });
</script>
<div class="row">
  <div class="col-md-3">
    @include('app.projectnav', [ 'project' => $project ])
    <br />
    <br />
    <div class="dropdown-menu dropdown-menu-demo ">
      <span class="dropdown-header">Project</span>
      <a class="dropdown-item" href="#timeline" data-toggle="modal" data-target="#modal-simple">
        <x-icon.invoice style="margin-right: 10px;" />
        <span>Invoice Project</span>
      </a>
      <a class="dropdown-item" href="#timeline"  data-toggle="modal" data-target="#editproject">
        <x-icon.edit style="margin-right: 10px;" />
        <span>Edit Project</span>
      </a>
      <form method="post" action="{{ route('projects.destroy', [ $project ]) }}" onsubmit="return confirm('Are you sure?')">
        @csrf
        @method('DELETE')

        <button type="submit" class="dropdown-item">
          <x-icon.delete style="margin-right: 10px;" />
          <span>Delete Project</span>
        </button>
      </form>
    </div>
    <br />
    <br />
    <div class="dropdown-menu dropdown-menu-demo">
      <span class="dropdown-header">Update Project Status</span>
      <div class="m-3">
        <form action="{{route('projectstatuschange')}}" method="post">
          @csrf
          <x-select-project-status
            :project="$project"
            name="status"
            id="status"
          />
          <input type="hidden" value="{{$project->id}}" name="id">
        </form>
      </div>
    </div>
    <br />
    <br />
    <form action="{{route('addprojectupdates')}}" method="post" class="card">
      @csrf
      <input type="hidden" name="project_id" value="{{$project->id}}" />
      <div class="card-header">
        <h3 class="card-title">Add Project Updates</h3>
      </div>
      <div class="card-body p-2">
        <textarea id="editornew" class="form-control" style="width: 100%;" placeholder="Update Project Status"  name="message" rows="3">
        </textarea>
      </div>
      <div class="card-footer">
        <div class="d-flex">
          <button type="submit" class="btn btn-primary ms-auto">Post</button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <dl class="row">
              <dt class="col-5">Project Name:</dt>
              <dd class="col-7"><strong>{{$project->name}}</strong></dd>
              <dt class="col-5">Client:</dt>
              <dd class="col-7">
                <a href="/client/{{$project->client->id}}">{{$project->client->name}}</a>
              </dd>
              <dt class="col-5">Start Date:</dt>
              <dd class="col-7"><strong>{{$project->starts_at}}</strong></dd>
              <dt class="col-5">Deadline:</dt>
              <dd class="col-7"><strong>{{$project->deadline}}</strong></dd>
              <dt class="col-5">Status:</dt>
              <dd class="col-7">
                <x-project-status :project="$project" />
              </dd>
              <dt class="col-5"></dt>
              <dd class="col-7"><strong></strong></dd>
            </dl>
          </div>
        </div>
      </div>
      @php
        $today = date("Y-m-d");
      @endphp
      <div class="col-md-4">
        <div class="card">
          <div class="card-body p-4 py-3 text-center">
            <span class="avatar avatar-xl mb-2 avatar-rounded @if($today>$project->deadline) bg-red-lt  @else bg-green-lt  @endif">{{$balanceDays}}</span>

            @if ( $today > $project->deadline )
              <h3 class="mb-0">Days Overdue</h3>
            @else
              <h3 class="mb-0">Days Left</h3>
            @endif
          </div>
        </div>
      </div>
      <div class="progress card-progress">
        <div class="progress-bar @if ( $today > $project->deadline ) bg-red  @else bg-green @endif" style="width: {{ $percentage }}%" role="progressbar" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
          <span class="visually-hidden">{{ $percentage }}% Complete</span>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8 mt-3">
    <div class="row">
      <div class="col-md-4 mb-2">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-green text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                    <path d="M12 3v3m0 12v3" />
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ $counts['income'] }}</div>
                <div class="text-muted">Income</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-2">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-yellow text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash-banknote-off" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M9.88 9.878a3 3 0 1 0 4.242 4.243m.58 -3.425a3.012 3.012 0 0 0 -1.412 -1.405" />
                    <path d="M10 6h9a2 2 0 0 1 2 2v8c0 .294 -.064 .574 -.178 .825m-2.822 1.175h-13a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h1" />
                    <line x1="18" y1="12" x2="18.01" y2="12" />
                    <line x1="6" y1="12" x2="6.01" y2="12" />
                    <line x1="3" y1="3" x2="21" y2="21" />
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ $counts['expense'] }}</div>
                <div class="text-muted">Expense</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-2">
        <div class="card card-sm">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-auto">
                <span class="bg-teal text-white avatar">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-wallet" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12" />
                    <path d="M20 12v4h-4a2 2 0 0 1 0 -4h4" />
                  </svg>
                </span>
              </div>
              <div class="col">
                <div class="font-weight-medium">{{ $counts['balance'] }}</div>
                <div class="text-muted">Balance</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--------- lead updates start --------->
    <div class="card" id="updates">
      <div class="card-header">
        <h3 class="card-title">Project Updates</h3>
      </div>
      <ul class="list-group card-list-group">
        @foreach ( $projectUpdates as $update )
          <li class="list-group-item">
            <div class="d-flex">
              <div>
              </div>
              <div class="flex-fill">
                <div>
                  <small class=" text-muted" style="float: right;">{{ $update->created_at->diffForHumans() }}</small>
                </div>
                <div>
                  {!! nl2br(e($update->message)) !!}
                  <a href="/projects/deleteupdates/{{ $update->id }}" style="float:right;" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-warning">Delete</a>
                  <a href="#" class="btn btn-sm" style="margin-right: 5px; float:right;"  data-toggle="modal" data-target="#editupdates{{ $update->id }}">Edit</a>
                </div>
              </div>
            </div>
          </li>
          <div class="modal modal-blur fade" id="editupdates{{ $update->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit Project Update</h5>
                  <b type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <line x1="18" y1="6" x2="6" y2="18" />
                      <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                  </b>
                </div>
                <form action="{{route('editprojectupdates')}}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $update->id }}" />
                  <div class="modal-body">
                    <div class="mb-2">
                      <textarea id="editornew" class="form-control" style="width: 100%;" placeholder="Update Project Status" name="message" rows="3">{!!$update->message !!}</textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn mr-auto" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        @endforeach
      </ul>
      <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">Showing {{ $projectUpdates->count() }} Updates</p>
        <ul class="pagination m-0 ms-auto">
          {{ $projectUpdates->links() }}
        </ul>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <h3 class="card-title">{{ __('Project_Invoices') }}</h3>
        <button type="button" href="#timeline" data-toggle="modal" data-target="#modal-simple" style="float: right; right:0; margin-right:10px; position: absolute;" class="btn btn-warning btn-sm">{{ __('Create_new_invoice') }}</button>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th>{{ __('INVO_ID') }}</th>
              <th>{{ __('TITLE') }}</th>
              <th>{{ __('DUE_DATE') }}</th>
              <th>{{ __('AMOUNT') }} </th>
              <th>{{ __('PAID') }}</th>
              <th>{{ __('STATUS') }}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $invoices as $invoice )
              <tr>
                <td># {{ $invoice->invoid }}</td>
                <td>
                  <a href="{{ route('editinvoice', ['id' => $invoice->id]) }}">{{ $invoice->title }}</a>
                </td>
                <td>{{ $invoice->duedate }}</td>
                <td>{{ $invoice->totalamount }}</td>
                <td>{{ $invoice->paidamount }}</td>
                <td><x-invoice-status :invoice="$invoice" /></td>
                <td class="text-right">
                  <span class="dropdown ml-1">
                    <button class="btn btn-white btn-sm dropdown-toggle align-text-top"data-boundary="viewport" data-toggle="dropdown">Actions</button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="/invoices/edit/{{ $invoice->id }}">{{ __('Edit_Invoice') }}</a>
                      <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="/invoices/delete/{{ $invoice->id }}">{{ __('Delete_Invoice') }}</a>
                    </div>
                  </span>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-muted">{{ __('Showing') }} {{ $invoices->count() }} {{ __('entries') }}</p>
        <ul class="pagination m-0 ms-auto">
          {{ $invoices->links() }}
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-4 mt-3">
    <form action="{{ route('updateprojectdescript') }}" method="post" class="card">
      @csrf
      <input type="hidden" name="id" value="{{ $project->id }}" />
      <div class="card-header">
        <h3 class="card-title">Sticky Notes</h3>
      </div>
      <div class="card-body p-2">
        <textarea id="editor" class="form-control" style="width: 100%;" name="description" rows="6">{!! $project->description !!}</textarea>
      </div>
      <div class="card-footer">
        <div class="d-flex">
          <button type="submit" class="btn btn-primary ms-auto">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="editproject" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Project</h5>
        <b type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </b>
      </div>
      <form action="{{ route('projects.update', [ $project ] ) }}" method="post">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-2">
            <label class="form-label">Project Title</label>
            <input type="text" class="form-control" name="name" value="{{ $project->name }}" placeholder="Project Title Here" />
          </div>
          <div class="mb-2">
            <label class="form-label">Start Date</label>
            <input type="date" value="{{ $project->starts_at }}" class="form-control" name="starts_at" placeholder="Start Date" />
          </div>
          <div class="mb-2">
            <label class="form-label">DeadLine</label>
            <input type="date" value="{{ $project->deadline }}" class="form-control" name="deadline" placeholder="DeadLine" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Update Project</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Invoice This Project</h5>
        <b type="button" class="close" data-dismiss="modal" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </b>
      </div>
      <form action="{{ route('createnewinvoice') }}" method="post">
        @csrf
        <input type="hidden" value="{{ $project->client->id }}" name="userid" />
        <input type="hidden" value="{{ $project->id }}" name="project_id" />
        <div class="modal-body">
          <div class="mb-2">
            <label class="form-label">Invoice Title</label>
            <input type="text" class="form-control" name="title" placeholder="Invoice Title Here" value="{{ $project->name }}" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Create Invoice</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<script>
  ClassicEditor
    .create( document.querySelector('#editor'), {
      'removePlugins': 'toolbar',
    })
    .catch((error) => {
      console.error( error );
    });
</script>

@endsection
