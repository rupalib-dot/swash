@extends('admin.inc.index')
@section('content')

    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Coupon Name</th>
                    <th>Coupon Discount</th>
                    <th>Coupon Expire Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($coupons) > 0 )
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }} </td>
                        <td>{{ $coupon->name }} </td>
                        <td><span style="max-width: 150px; display: block;">{{ $coupon->address }}</span> </td>
                        <td>{{ $coupon->postcode }} </td>
                        <td>{{ $coupon->capacity }} </td>
                        <td> <a href="{{route('coupons.edit',base64_encode($coupon->id))}}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{route('coupons.delete',base64_encode($coupon->id))}}" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="6" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
