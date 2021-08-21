@extends('admin.inc.index')
@section('content')
<style>
 .booking-table p {
    font-size: 14px;
    margin-bottom: 0px;
    width: 200px;
}
</style>
    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered booking-table" style="width:100%">
            <thead>
                <tr>
                    <th>Booking ID (Order ID)</th>
                    <th>Car Details</th>
                    <th>Booking Price</th>
                    <th>Booking Location</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($bookings) > 0 )
                    @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }} </td>
                        <td>
                             <p><b>Car Type: </b>{{ $booking->car }}</p>
                            <p><b>Car Plate: </b>{{ $booking->car_plate }}</p>
                            <p><b>Car Brand: </b>{{ $booking->car_brand }}</p>
                            <p><b>Carpark Address: </b>{{ $booking->carpark_add }}</p>
                            <p><b>Mobile Number: </b>{{ $booking->mobile_number }}</p>
                        </td>
                        <td>${{ $booking->price }}</td>
                        <td>{{ $booking->location_name }}</td>
                        <td>{{ $booking->date }}</td>
                        <td> <a href="{{route('booking.show',base64_encode($booking->id))}}" class="btn btn-primary btn-sm">View</a> </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="6" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
