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
                    <div class="card-title">Software Settings</div>
                    <div class="mb-2">
                       Configure Your Business name and logo etc
                    </div>
                   
                    <form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Your Business Name</label>
                            <input type="text" class="form-control" name="businessname" value="{{ $settings->companyname}}">
                        </div>
                       
                       
                        <div class="mb-3">
                            <label class="form-label">Logo (.png)</label>
                            <input type="file" class="form-control" name="logo">
                        </div>

               



                        <button type="submit" style="float: right" class="btn btn-success">
                            Update Software
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
