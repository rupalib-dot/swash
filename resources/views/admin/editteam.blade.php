@extends('admin.inc.index')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline" style="padding: 15px">
                <h3>Follow The Instruction</h3>
                <ul>
                    <li>Member Name is <span style="color:red">Require</span></li>
                    <li>Member Email is <span style="color:red">Require</span></li>
                    <li>Member Phone is <span style="color:red">Require</span></li>
                    <li>Member Location is <span style="color:red">Require</span></li>
                    <li>Member Address is <span style="color:green">not require</span></li>
                    <li>Member Postcode is <span style="color:green">not require</span></li>
                    <li>Member photo is <span style="color:green">not require</span></li>
                </ul>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h3 class="para-family heading-bottom text-center">Edit Team Member account</h3>
                    @include('inc.msg')
                    <br>
                    <form action="{{ route('teams.update', $team->id)}}" method="POST" enctype="multipart/form-data"
                        id="general_form">
                        @csrf
                        @method('put')
                        <div class="form-group col-12">
                            <input type="text" class="form-control" value="{{ old('name', $team->name) }}" name="name"
                                aria-describedby="emailHelp" placeholder="Member Name" required>
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <input type="email" class="form-control" value="{{ old('email', $team->email) }}"
                                name="email" aria-describedby="emailHelp" placeholder="Member Email" required>
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-12">

                            <input type="tel" class="form-control" value="{{ old('phone', $team->phone) }}" name="phone"
                                minlength="9" maxlength="11" aria-describedby="emailHelp"
                                placeholder="Member Phone Number" onkeypress="return isNumber(event)" required>
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <textarea name="address" class="form-control"
                                placeholder="Member Address">{{ old('address', $team->address) }}</textarea>
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <input type="text" class="form-control" value="{{ old('postcode', $team->postcode) }}"
                                name="postcode" aria-describedby="emailHelp" placeholder="Member Postcode" minlength="5"
                                maxlength="10" onkeypress="return isNumber(event)" required>
                            @error('postcode')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @if (count($locations) > 0)
                        <div class="form-group col-12">
                            <select name="location" class="form-control">
                                <option value="">Select Location</option>
                                @foreach ( $locations as $location )
                                <option value="{{ $location->id }}" @if ($team->location == $location->id)
                                    selected
                                    @endif>{{ $location->name }}</option>
                                @endforeach
                            </select>

                            @error('location')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        @else
                        <div class="col-md-12 form-group">

                            <P class="text-danger">Locations is required, First Please add location</P><br>
                        </div>
                        @endif
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>

                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p><br>
                            @enderror
                            @if ($team->photo)
                            <img style="max-width: 150px;
                                margin-bottom: 15px;
                                box-shadow: 0px 0px 10px #767070;
                                border-radius: 9px;
                            }" src="{{ asset('public/storage/image/'.$team->photo) }}" />
                            @endif
                        </div>
                        <div class="text-left col-12">
                            <button type="submit" class="btn btn-primary btn-inline-block">Update Member</button>
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
