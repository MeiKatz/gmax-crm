@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

<div class="container-xl">
    <div class="row">
        <div class="col-lg-4">
          @include('admin.settings._settingsmenu')
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Payment Gateway Settings</div>
                    <div class="mb-2">
                       Configure Your Payment Gateways
                    </div>
                </div>    
            </div>
            @foreach($gateways as $gateway)
            <div class="card" style="margin-top:15px;">
                <div class="card-header">
                  <h3 class="card-title">{!!$gateway->icon!!} {{$gateway->gatewayname}}</h3>
                  <div class="col-auto ms-auto">
                      <form action="{{route('admin.settings.payment-gateway.status')}}" method="post">
                        @method('PUT')
                          @csrf
                          <input type="hidden" name="id" value="{{$gateway->id}}">
                            <label class="form-check form-switch m-0">
                            <input class="form-check-input position-static" name="status" onchange="this.form.submit()"  type="checkbox" @if($gateway->status==1) value="0" checked @else value="1" @endif >
                            </label>
                      </form> 
                  </div>
                </div>
                @if($gateway->status==1) 
                <div class="card-body">
                    <form action="{{route('admin.settings.payment-gateway.update')}}" method="post">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{$gateway->id}}">
                   <div class="row">
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="paytitle" value="{{$gateway->paytitle}}" placeholder="Title">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">API Key</label>
                            <input type="text" class="form-control" name="apikey" value="{{$gateway->apikey}}" placeholder="API Key">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <label class="form-label">API Secret</label>
                            <input type="text" class="form-control" name="apisecret" value="{{$gateway->apisecret}}" placeholder="API Secret">
                        </div>
                    </div>
                   </div>
                 
                    <div class="d-flex" style="margin-top:10px;">
                    <button type="submit" class="btn btn-success ms-auto">{!!$gateway->icon!!}  Update {{$gateway->gatewayname}}</button>
                    </div>
                    </form> 
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
