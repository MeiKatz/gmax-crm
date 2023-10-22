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
                
                   
                    <form action="{{route('admin.settings.billing.update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                                                           
                        <div class="card-title">Currency Settings</div>
                        <div class="mb-2">
                           Update Your Currency Settings it will visible in your invoices and quotes
                         </div>
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Prefix</label>
                                    <input type="text" class="form-control" name="prefix" value="{{$settings->prefix}}" placeholder="$">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Suffix</label>
                                    <input type="text" class="form-control" name="suffix" value="{{$settings->suffix}}" placeholder="USD">
                                </div>
                            </div>
                           </div>

                           <hr style="margin-top: 25px; margin-bottom: 25px;">

                                                              
                        <div class="card-title">Tax Settings</div>
                        <div class="mb-2">
                           Update Your Tax Settings it will affect in your invoices and quotes
                         </div>
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Tax Name</label>
                                    <input type="text" class="form-control" name="taxname" value="{{$settings->taxname}}" placeholder="GST">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Tax Percentage %</label>
                                    <input type="text" class="form-control" name="taxpercent" value="{{$settings->taxpercent}}" placeholder="18">
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="mb-2" >
                                    <label class="form-label">Enable Tax</label>
                                    <label class="form-check">                                      
                                        <input class="form-check-input" name="taxstatus" value="1" type="checkbox" @if($settings->taxstatus==1) checked @endif>
                                        <span class="form-check-label">Check to enable</span>
                                      </label>
                                </div>
                            </div>
                           </div>

                           <hr style="margin-top: 25px; margin-bottom: 25px;">
                                                              
                        <div class="card-title">Thanks Note</div>
                        <div class="mb-2">
                           Update Thanks Notes which showing in Invoice and Quote
                         </div>
                        <div class="row">
                           
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="form-label">Invoice Note</label>
                                    <textarea class="form-control" name="invoicenote"  placeholder="Invoice Note">{{$settings->invoicenote}} </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="form-label">Quote Note</label>
                                    <textarea class="form-control" name="quotenote" placeholder="Quote Note">{{$settings->quotenote}}</textarea>
                                </div>
                            </div>
                           </div>

                        <button type="submit" style="float: right; margin-top: 15px;" class="btn btn-success">
                            Update Billing
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
