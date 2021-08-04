@extends('admin.inc.index')
@section('content')

    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Black Out ID</th>
                    <th>Black Out Start Date</th>
                    <th>Black Out End Date</th>
                    <th>Black Out Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($blackouts) > 0 )
                    @foreach ($blackouts as $blackout)
                    <tr>
                        <td>{{ $blackout->id }} </td>
                        <td>{{ $blackout->startdate }} </td>
                        <td>{{ $blackout->enddate }} </td>
                        <td>{{ getLocationName($blackout->location) }} </td>
                        <td> <a href="{{route('blackout.edit',base64_encode($blackout->id))}}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{route('blackout.delete',base64_encode($blackout->id))}}" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="5" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
