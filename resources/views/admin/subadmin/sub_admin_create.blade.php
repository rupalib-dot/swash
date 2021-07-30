@extends('admin.layouts.app')

@section('content')
<style>
p{
    font-size:17px;
    padding:15px 0px 5px 0px !important;
}
i{
    color:red;
}
svg.feather-eye {
    position: absolute;
    top: 42px;
    right: 24px;
    color: #888ea8;
    fill: rgba(0, 23, 55, 0.08);
    width: 17px;
    cursor: pointer;
}
</style>
    <div class="container-fluid">
        <div class="row layout-top-spacing" id="cancel-row">
            <div id="ftFormArray" class="col-lg-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{ isset($record_data) ? 'Update' : 'Create' }} Sub Admin</h4> 
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area custom-autocomplete h-100"> 
                        <form action="{{ route('sub_admin.update', isset($record_data) ? base64_encode($record_data->user_id) : base64_encode(0) )}}" method="POST" enctype="multipart/form-data" id="general_form">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Full Name <i>*</i></label>
                                    <input type="text" class="form-control basic" maxlength="32" name="user_name" value="{{ old('user_name', isset($record_data) ? $record_data->user_name : '') }}" placeholder="Full Name" onkeypress="return IsAlphaApos(event, this.value, '32')" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Account ID <i>*</i></label>
                                    <input type="text" class="form-control" maxlength="10" name="account_id" value="{{ old('account_id', isset($record_data) ? $record_data->account_id : '') }}" placeholder="Account ID" required style="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Email Address <i>*</i></label>
                                    <input type="text" class="form-control" maxlength="50" name="email_address" value="{{ old('email_address', isset($record_data) ? $record_data->email_address : '') }}" placeholder="Email Address" required>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Role <i>*</i></label>
                                    <select name="role_id" class="form-control" required>
                                        <option value="">== Select Services ==</option>
                                        @foreach($role_list as $rec)
                                            <option {{ old('role_id', isset($record_data) ? $record_data->user_role->role_id : '') == $rec->role_id ? 'selected' : ''}} value="{{$rec->role_id}}">{{substr($rec->role_title, strpos($rec->role_title, '_') + 1)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Password</label>
                                    <input type="password" class="form-control basic" maxlength="16" name="password" id="password" value="" placeholder="Password" {{ isset($record_data) ? 'password' : '' }} >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="form-group col-6 custom-file-container">
                                    <label for="email1">Nationality <i>*</i></label>
                                    <select name="nationality_id" class="form-control">
                                        <option value="">All</option>
                                        @foreach($nationality as $rec)
                                            <option {{ old('nationality_id', isset($record_data) ? $record_data->nationality_id : '') == $rec->misc_id ? 'selected' : ''}} value="{{$rec->misc_id}}">{{$rec->misc_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Save & Exit')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    var togglePassword = document.getElementById("toggle-password");
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        });
    }
    </script>
@endsection  