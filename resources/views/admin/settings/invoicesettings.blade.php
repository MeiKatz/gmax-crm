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
                
                   
                    <form action="{{route('admin.settings.invoice.update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                                                           
                        <div class="card-title">Customize Invoice</div>
                        <div class="mb-2">
                           Add/Change Invoice Header and Footer Images. 
                         </div>
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Invoice Header</label>
                                    <input type="file" class="form-control" name="headerimage" value="{{$business->headerimage}}" placeholder="Logo">
                                </div>
                                <img src="/storage/uploads/{{$business->headerimage}}">
                                <br>
                                <div class="mt-4" >
                                    <label class="form-label">Hide Basic Logo?</label>
                                    <label class="form-check">                                      
                                        <input class="form-check-input" name="enablelogo" value="1" type="checkbox" @if($business->enablelogo==1) checked @endif>
                                        <span class="form-check-label">Check this if you have a logo image on Header Image File</span>
                                      </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Invoice Footer</label>
                                    <input type="file" class="form-control" name="footerimage" value="{{$business->footerimage}}" placeholder="Logo">
                                </div>
                                <img src="/storage/uploads/{{$business->footerimage}}">
                            </div>
                           </div>

                         

                        <button type="submit" style="float: right; margin-top: 15px;" class="btn btn-success">
                            Update Invoice
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
