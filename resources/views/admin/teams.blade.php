@extends('admin.inc.index')
@section('content')

    <div class="card-body" style="background-color: #fff">
        @include('inc.msg')
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Member Name</th>
                    <th>Member Email</th>
                    <th>Member Phone</th>
                    <th>Member Location</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($teams) > 0 )
                    @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team->id }} </td>
                        <td>{{ $team->name }} </td>
                        <td>{{ $team->email }} </td>
                        <td>{{ $team->phone }} </td>
                        <td>{{ getLocationName($team->location) }} </td>
                        <td> <a href="{{route('teams.edit',base64_encode($team->id))}}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{route('teams.delete',base64_encode($team->id))}}" class="btn btn-danger btn-sm">Delete</a> </td>
                    </tr>
                    @endforeach
                @else
                <td valign="top" colspan="6" class="dataTables_empty">Records Not found</td>
                @endif


            </tbody>
        </table>
    </div>

        @endsection
