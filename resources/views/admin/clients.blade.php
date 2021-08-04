@extends('admin.inc.index')
@section('content')
    <div class="container-fluid">
        <div class="card">

            <!-- /.card-header -->
            <div class="card-body">
                @include('inc.msg')
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if (count($clients) > 0)
                                @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->id }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        @if ($client->status == 'active')
                                        <a class="btn btn-primary btn-sm" href="{{route('updateStatus',base64_encode($client->id))}}">Deactive</a>
                                        @else
                                        <a class="btn btn-danger btn-sm" href="{{route('updateStatus',base64_encode($client->id))}}">Active</a>
                                        @endif
                                        <a class="btn btn-success btn-sm" href="{{route('client.edit',base64_encode($client->id))}}">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <td valign="top" colspan="5" class="dataTables_empty">Records Not found</td>
                            @endif

                    </tbody>

                </table>
            </div>
            <!-- /.card-body -->
        </div>

    </div><!-- /.container-fluid -->
@endsection
