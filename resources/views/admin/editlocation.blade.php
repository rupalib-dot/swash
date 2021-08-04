@extends('admin.inc.index')
@section('content')
<style>
    .map-show{
        padding: 15px;
    }
.map-show iframe{
    width: 100%; height: 450px;
}
</style>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-5">

        <!-- Profile Image -->
        <div class="card card-primary card-outline map-show">
            <h3>Map</h3>
            @if ($location->map)
             {!! $location->map !!}
            @else
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d51955155.42607942!2d65.84289044097503!3d37.36402291002488!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1627734810802!5m2!1sen!2sin" style="" allowfullscreen="" loading="lazy"></iframe>
            @endif

        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
      <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h3 class="para-family heading-bottom text-center">Update location account</h3>
                @include('inc.msg')
                <br>
                <form action="{{ route ('locations.update',$location->id) }}" method="POST" enctype="multipart/form-data" id="general_form">
                    @csrf
                    @method('put')
                    <div class="form-group col-12">
                        <input type="text" class="form-control" value="{{ old('name', isset($location) ? $location->name : '') }}" name="name" aria-describedby="emailHelp"
                            placeholder="Location Name" required>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <input type="text" class="form-control" value="{{ old('address', isset($location) ? $location->address : '') }}" name="address" aria-describedby="emailHelp" placeholder="Location Address" required>
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <input type="text" class="form-control" value="{{ old('postcode', isset($location) ? $location->postcode : '') }}" name="postcode" aria-describedby="emailHelp" placeholder="Location Postcode" minlength="5" maxlength="10" onkeypress="return isNumber(event)" required>
                        @error('postcode')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <input type="text" class="form-control" value="{{ old('capacity', isset($location) ? $location->capacity : '') }}" name="capacity" aria-describedby="emailHelp"
                            placeholder="Location Capacity" minlength="1" maxlength="2" onkeypress="return isNumber(event)" required>
                        @error('capacity')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <textarea class="form-control" name="map">{{ old('map', isset($location) ? $location->map : '') }}</textarea>
                        @error('map')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-left col-12">
                        <button type="submit" class="btn btn-primary btn-inline-block">Update Location Data</button>
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

