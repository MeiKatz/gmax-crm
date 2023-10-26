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
                
                   
                    <form action="{{route('admin.settings.business.update')}}" method="post" enctype="multipart/form-data">
                        @csrf

                                                           
                        <div class="card-title">Business Settings</div>
                        <div class="mb-2">
                           Update Your Business informations it will visible in your invoices and quotes
                         </div>
                        <div class="row">
                           
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" class="form-control" name="businessname" value="{{$business->businessname}}" placeholder="Business Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$business->email}}" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="contactnum" value="{{$business->contactnum}}" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Tax Info</label>
                                    <input type="text" class="form-control" name="taxid" value="{{$business->taxid}}" placeholder="Tax Info">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label class="form-label">Logo</label>
                                    <input type="file" class="form-control" name="logo" value="{{$business->logo}}" placeholder="Logo">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="" style="margin-top:30px;">
                                  
                                   <img src="/storage/uploads/{{$business->logo}}" height="30">
                                </div>
                            </div>
                        
                        </div>

                           <hr style="margin-top: 25px; margin-bottom: 25px;">

                     
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{$business->address}}" placeholder="Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Address Line 2</label>
                                    <input type="text" class="form-control" name="address2" value="{{$business->address2}}" placeholder="Address Line 2">
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{$business->city}}" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" value="{{$business->state}}" placeholder="State">
                                </div>
                            </div>
                          

                            
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{$business->country}}" placeholder="Country">
                                </div>
                            </div>
                           
                          
                          
                           </div>

                         

                        <button type="submit" style="float: right; margin-top: 15px;" class="btn btn-success">
                            Update Business Info
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
