@extends('admin.inc.index')
@section('content')

    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Location ID</th>
                    <th>Location Name</th>
                    <th>Location Address</th>
                    <th>Location Postcode</th>
                    <th>Location Capacity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($locations) > 0 )
                    @foreach ($locations as $location)
                    <tr>
                        <td>{{ $location->id }} </td>
                        <td>{{ $location->name }} </td>
                        <td><span style="max-width: 150px; display: block;">{{ $location->address }}</span> </td>
                        <td>{{ $location->postcode }} </td>
                        <td>{{ $location->capacity }} </td>
                        <td> <a href="{{route('locations.edit',base64_encode($location->id))}}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{route('locations.delete',base64_encode($location->id))}}" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="6" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
