@extends('admin.inc.index')
@section('content')
<style>
    h4{
        color: #007bff
    }
</style>
<div class="container-fluid">
    @include('inc.msg')
    <form action="{{ route('updateSetting') }}" method="POST" enctype="multipart/form-data" id="general_form">
        @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="padding: 15px">
                <h4>Payment Setting</h4>
                <div class="form-group col-12">
                    <label>Currency Code</label>
                    <input type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" value="{{ old('currency', $settings->currency) }}" name="currency" maxlength="3" required>
                    @error('currency')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>API Publishable</label>
                    <input type="text" class="form-control" value="{{ old('payment_key_1', $settings->payment_key_1) }}" name="payment_key_1" maxlength="3" required>
                    @error('payment_key_1')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>API Secret</label>
                    <input type="text" class="form-control" value="{{ old('payment_key_2', $settings->payment_key_2) }}" name="payment_key_2" maxlength="3" required>
                    @error('payment_key_2')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card -->

        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="padding: 15px">
                <h4>Trial Car Wash Price</h4>
                <div class="form-group col-12">
                    <label>With Trial Sedan/Hatchback</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_trial_price_1', $settings->car_trial_price_1) }}" name="car_trial_price_1" onblur="formatDecimal(this)" required>
                    @error('car_trial_price_1')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>With Trial SUV/MPV</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_trial_price_2', $settings->car_trial_price_2) }}" name="car_trial_price_2" onblur="formatDecimal(this)" required>
                    @error('car_trial_price_2')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>With Trial Van/Lorry</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_trial_price_3', $settings->car_trial_price_3) }}" name="car_trial_price_3" onblur="formatDecimal(this)" required>
                    @error('car_trial_price_3')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card -->

        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="padding: 15px">
                <h4>Without Trial Car Wash Price</h4>
                <div class="form-group col-12">
                    <label>Sedan/Hatchback</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_price_1', $settings->car_price_1) }}" name="car_price_1" onblur="formatDecimal(this)" required>
                    @error('car_price_1')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>SUV/MPV</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_price_2', $settings->car_price_2) }}" name="car_price_2" onblur="formatDecimal(this)" required>
                    @error('car_price_2')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>Van/Lorry</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="{{ old('car_price_3', $settings->car_price_3) }}" name="car_price_3" onblur="formatDecimal(this)" required>
                    @error('car_price_3')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card -->

        </div>
        <div class="col-md-4">
            <div class="card card-primary card-outline" style="padding: 15px">
                <h4>Discount Setting</h4>
                <div class="form-group col-12">
                    <label>(A) Automatic discount Session </label>
                    <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('auto_discount_1', $settings->auto_discount_1) }}" name="auto_discount_1" required>
                    @error('auto_discount_1')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>(A) Discount Session (In Persent)</label>
                    <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('auto_discount_percent_1', $settings->auto_discount_percent_1) }}" name="auto_discount_percent_1" required>
                    @error('auto_discount_percent_1')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>(B) Automatic discount Session </label>
                    <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('auto_discount_2', $settings->auto_discount_2) }}" name="auto_discount_2" required>
                    @error('auto_discount_2')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-12">
                    <label>(B) Discount Session (In Persent)</label>
                    <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('auto_discount_percent_2', $settings->auto_discount_percent_2) }}" name="auto_discount_percent_2" required>
                    @error('auto_discount_percent_2')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <h4>Loyalty Setting</h4>
                <div class="form-group col-12">
                    <label>Loyalty Point Discount  (In Persent)</label>
                    <input type="text" onkeypress="return isNumber(event)" maxlength="2" class="form-control" value="{{ old('loyalty_point_discount', $settings->loyalty_point_discount) }}" name="loyalty_point_discount" required>
                    @error('loyalty_point_discount')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- /.card -->

        </div>
        <div class="text-left col-12">
            <button type="submit" class="btn btn-primary btn-inline-block">Update Application Settings</button>
        </div>
    </div>
</form>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
