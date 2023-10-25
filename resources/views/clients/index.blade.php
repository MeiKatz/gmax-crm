@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Client Manager</h3>
    </div>

    <div class="table-responsive">
      <table class="table card-table table-vcenter text-nowrap datatable">
        <thead>
            <tr>
                <th>Name </th>
                <th>Business </th>
                <th>Email </th>
                <th>Phone </th>
                <th>Type </th>
                <th>Status </th>
                <th>Added</th>                
                <th></th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($clients as $client)
            <tr>
                <td><a href="/client/{{$client->id}}" class="text-reset" tabindex="-1"> {{$client->name}}</a></td>
                <td>
                    
                    {{$client->business}}
                </td>
                <td>
                    {{$client->email}}
                </td>
                <td> {{$client->phone}}
                </td>
                <td> {{$client->phone}}
                </td>
                <td>
                    <span class="badge bg-cyan">New</span> </td>
                <td>{{$client->created_at->diffForHumans()}}</td>
                
                <td class="text-right">
                    <span class="dropdown ml-1">
                        <button class="btn  btn-sm dropdown-toggle align-text-top"
                            data-boundary="viewport" data-toggle="dropdown">Actions</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/client/edit/{{$client->id}}">
                                Edit Client
                            </a>
                            <form class="dropdown-item" method="post" action="{{ route('clients.destroy', [ $client ]) }}" onsubmit="return confirm('Warning: All Projects and Invoices will deleted with client. Are you sure?')">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}" />
                                <button type="submit">Delete Client</button>
                            </form>
                        </div>
                    </span>
                </td>
            </tr>
           @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-muted">Showing  {{$clients->count()}} entries</p>
      <ul class="pagination m-0 ms-auto">
        {{$clients->links()}}
      </ul>
    </div>
  </div>

    

@endsection
