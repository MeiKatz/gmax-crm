@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="card">
    <div class="card-body">
      <h3 class="card-title">Edit Client - {{$client->name}}</h3>
      <form action="{{ route('clients.update') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $client->id }}"/>
      <div class="row">
        <div class="col-md-4">
            <div class="mb-2">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" value="{{$client->name}}" placeholder="Name">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{$client->email}}" name="email" placeholder="Email">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" value="{{$client->phone}}" name="phone" placeholder="Phone">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Business Name</label>
                <input type="text" class="form-control" value="{{$client->business}}" name="business" placeholder="Business name">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Tax ID </label>
                <input type="text" class="form-control" value="{{$client->taxid}}" name="taxid" placeholder="Tax ID ">
            </div>
        </div>
      
        
        <hr style="margin-top: 15px; margin-bottom: 15px;">
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" value="{{$client->address}}" name="address"  placeholder="Address">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Address Line 2</label>
                <input type="text" class="form-control" value="{{$client->address2}}" name="address2"  placeholder="Address Line 2">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">City</label>
                <input type="text" class="form-control" value="{{$client->city}}" name="city"  placeholder="City">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">State</label>
                <input type="text" class="form-control" value="{{$client->state}}" name="state"  placeholder="State">
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">Country </label>
                <x-select-country
                    name="country"
                    id="select-users"
                />
            </div>
        </div>
        <div class="col-sm-4 col-md-4">
            <div class="mb-2">
                <label class="form-label">ZIP Code</label>
                <input type="text" class="form-control" value="{{$client->zip}}" name="zip"  placeholder="ZIP">
            </div>
        </div>

    </div>
    </div>
    <!-- Card footer -->
    <div class="card-footer">
      <div class="d-flex">
        <a href="/" class="btn btn-link">Cancel</a>
        <button type="submit" class="btn btn-primary ms-auto">Edit Client</button>
      </div>
    </form>
    </div>
  </div>

@endsection
