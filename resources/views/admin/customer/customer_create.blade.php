@extends('admin.layouts.app')

@section('content')
 
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{$title}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('customers.update', isset($record_data) ? base64_encode($record_data->user_id) : base64_encode(0) )}}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')  
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Name <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="50" name="name" value="{{ old('name', isset($record_data) ? $record_data->name : '') }}" placeholder="Name" onkeypress="return IsAlphaApos(event, this.value, '50')">
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Email <i>*</i></label>
                                    <input type="email" class="form-control basic" maxlength="100" name="email" value="{{ old('email', isset($record_data) ? $record_data->email : '') }}" placeholder="Email">
                                </div>
                            </div>
                            </div> <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Mobile Number</label>
                                    <input type="text" class="form-control basic" maxlength="15" name="phone" value="{{ old('phone', isset($record_data) ? $record_data->phone : '') }}" placeholder="Phone" onkeypress="return IsNumber(event, this.value, '15')" >
                                </div>  
                                @if(!isset($record_data))
                                    <div class="form-group col-6 custom-file-container">
                                        <label for="email1">Password</label>
                                        <input type="password" class="form-control basic" maxlength="16" name="password" id="password" value="" placeholder="Password" {{ isset($record_data) ? 'password' : '' }} >
                                        <svg style="cursor: pointer; position: relative; top: -32px; left: 94%;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    </div> 
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Save & Exit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection  