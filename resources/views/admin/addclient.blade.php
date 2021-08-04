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
                   src="@if ($client->photo != null){{ asset('public/storage/image/'.$client->photo) }}@else{{ asset('public/dist/img/user4-128x128.jpg') }}
                   @endif" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $client->name }}</h3>

            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{ $client->email }}</a>
              </li>
              <li class="list-group-item">
                <b>Phone</b> <a class="float-right">{{ $client->phone }}</a>
              </li>
              <li class="list-group-item">
                <b>Number of Booking</b> <a class="float-right">0</a>
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
                <h3 class="para-family heading-bottom text-center">Edit client account</h3>
                @include('inc.msg')
                <br>
                <form action="{{ route('client.update', isset($client) ? base64_encode($client->id) : base64_encode(0) )}}" method="POST" enctype="multipart/form-data" id="general_form">
                    @csrf
                    @method('PUT')
                    <div class="form-group col-12">
                        <input type="hidden" name="id" value="{{ $client->id }}">
                        <input type="text" class="form-control" value="{{ old('name', isset($client) ? $client->name : '') }}" name="name" aria-describedby="emailHelp"
                            placeholder="Full Name" required>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">

                        <input type="tel" class="form-control" value="{{ old('phone', isset($client) ? $client->phone : '') }}" name="phone" minlength="9" maxlength="11" aria-describedby="emailHelp" placeholder="Phone Number"
                            onkeypress="return isNumber(event)" required>
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <input type="email" value="{{ old('email', isset($client) ? $client->email : '') }}" class="form-control" name="email" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter email" required>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="text-left col-12">
                        <button type="submit" class="btn btn-primary btn-inline-block">Update Client Data</button>
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

@endsection

