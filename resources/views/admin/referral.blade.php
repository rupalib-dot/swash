@extends('admin.inc.index')
@section('content')

    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Coupon ID</th>
                    <th>Coupon Name</th>
                    <th>Coupon User(ID)</th>
                </tr>
            </thead>
            <tbody>
                @if (count($coupons) > 0 )
                    @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }} </td>
                        <td>{{ $coupon->coupon }} </td>
                        <td>{{ $coupon->user_id }} </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="5" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
