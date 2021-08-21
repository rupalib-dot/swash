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
            <h3>Instruction</h3>
            <ul>
                <li>Coupons name is <span style="color: red">Required<span></li>
                <li>Coupons discount is <span style="color: red">Required<span></li>
                <li>Coupons expire date is <span style="color: red">Required<span></li>
            <ul>

        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
      <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <h3 class="para-family heading-bottom text-center">Update Coupon</h3>
                @include('inc.msg')
                <br>
                <form action="{{ route('coupons.update', $coupon->id )}}" method="POST" enctype="multipart/form-data" id="general_form">
                    @csrf
                    @method('put')
                    <div class="form-group col-md-12">
                        <label>Name:</label>
                        <input type="text" class="form-control"  minlength="6" oninput="this.value = this.value.toUpperCase()" name="name" maxlength="6" value="{{ old('name', $coupon->name) }}" required />
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Discount  (In Persent)</label>
                        <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('discount', $coupon->discount) }}" name="discount" required>
                        @error('discount')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label>Expire Date:</label>
                        <div class="input-group date"  id="reservationdate2" data-target-input="nearest">
                            <input type="text" value="{{ old('valide_date', $coupon->valide_date) }}" name="valide_date" class="form-control datetimepicker-input"  data-target="#reservationdate2" data-toggle="datetimepicker" autocomplete="off" />
                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        @error('valide_date')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
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

