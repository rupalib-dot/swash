@extends('admin.inc.index')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">

            <!-- Profile Image -->
            <div class="card card-primary card-outline" style="padding: 15px">
                <h3>Follow The Instruction</h3>
                <ul>
                    <li>Black Out Start date is <span style="color:red">Require</span></li>
                    <li>Black Out End date is <span style="color:red">Require</span></li>
                    <li>Black Out Location is <span style="color:red">Require</span></li>
                </ul>
            </div>
            <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h3 class="para-family heading-bottom text-center">Update Black Out List</h3>
                    @include('inc.msg')
                    <br>
                    <form action="{{ route('blackout.update', $blackout->id )}}" method="POST" enctype="multipart/form-data" id="general_form">
                        @csrf
                        @method('put')
                        <div class="form-group col-md-12">
                            <label>Start Date:</label>
                            <div class="input-group date"  id="reservationdate" data-target-input="nearest">
                                <input type="text" value="{{ old('startdate', $blackout->startdate) }}" name="startdate" class="form-control datetimepicker-input"  data-target="#reservationdate" data-toggle="datetimepicker"  autocomplete="off" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('startdate')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label>End Date:</label>
                            <div class="input-group date"  id="reservationdate2" data-target-input="nearest">
                                <input type="text" value="{{ old('enddate', $blackout->enddate) }}" name="enddate" class="form-control datetimepicker-input"  data-target="#reservationdate2" data-toggle="datetimepicker" autocomplete="off" />
                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('enddate')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (count($locations) > 0)
                        <div class="form-group col-12">
                            <label>Location:</label>
                            <select name="location" class="form-control">
                                <option value="">Select Location</option>
                                @foreach ( $locations as $location )
                                <option value="{{ $location->id }}" @if($blackout->location == $location->id)
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
                        <div class="text-left col-12">
                            <button type="submit" class="btn btn-primary btn-inline-block">Update List</button>
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

