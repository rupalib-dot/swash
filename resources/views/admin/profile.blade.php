@extends('admin.inc.index')
@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-5">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" style="height: 150px; width: 150px"
                   src="@if ($student->photo != null){{ asset('public/storage/users/'.$student->photo) }}@else{{ asset('public/dist/img/user4-128x128.jpg') }}
                   @endif" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $student->name }}</h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{ $student->email }}</a>
              </li>
              <li class="list-group-item">
                <b>Phone</b> <a class="float-right">+{{ $student->dialcode }}-{{ $student->phone }}</a>
              </li>
              <li class="list-group-item">
                <b>Assignments</b> <a class="float-right">{{ userAssignmentCount(session('ADMIN_ID')) }}</a>
              </li>
            </ul>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
      <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h3 class="para-family heading-bottom text-center">Your Profile</h3>
                @include('inc.msg')
                <br>
                <form class="user-form row" method="POST" enctype="multipart/form-data"
                    action="{{ route('updateprofile') }}">
                    @csrf
                    <div class="form-group col-12">
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <input type="hidden" name="iso" value="{{ $student->iso }}" id="iso">
                        <input type="hidden" name="dialcode" value="{{ $student->dialcode }}" id="dialcode">
                        <input type="text" class="form-control" value="{{ $student->name }}" name="name" aria-describedby="emailHelp"
                            placeholder="Full Name" required>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <input type="tel" class="form-control" value="{{ $student->phone }}" name="phone" minlength="9" maxlength="11" id="phone"
                            aria-describedby="emailHelp" placeholder="Phone Number"
                            onkeypress="return isNumber(event)" required>
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <input type="email" value="{{ $student->email }}" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" required>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                            required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="password-show" onclick="showpossword('password')"><i class="fa fa-eye" aria-hidden="true"></i></span>
                              </div>
                          </div>

                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            placeholder="Reenter Password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="password_confirmation-show" onclick="showpossword('password_confirmation')"><i class="fa fa-eye" aria-hidden="true"></i></span>
                              </div>
                          </div>

                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="text-left col-12">
                        <button type="submit" class="btn btn-primary btn-inline-block">Update Profile</button>
                    </div>
                </form>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  <script>
    var input = document.querySelector("#phone");
    var iti = window.intlTelInput(input, {
     'separateDialCode' : true,
     'initialCountry' : '{{ $student->iso }}'
    });
    input.addEventListener("countrychange", function() {
   document.getElementById('iso').value = iti.getSelectedCountryData().iso2;
   document.getElementById('dialcode').value = iti.getSelectedCountryData().dialCode;
    });
  </script>
@endsection

