@extends('admin.layouts.app')

@section('content')
 
    <div class="container-fluid">
        <div class="row layout-top-spacing">
            <div id="tableSimple" class="col-lg-12 col-12 layout-spacing">
                @include('admin.inc.validation_message')
                @include('admin.inc.auth_message')
                <div class="statbox widget box box-shadow mb-1">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>{{$title}}</h4>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('customers.index')}}" method="GET">
                        <div class="widget-content widget-content-area">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <input type="text" maxlength="10" class="form-control mb-3 mb-md-0" name="user_code" placeholder="User Code" value="{{$request->user_code}}"> 
                                </div>
                                <div class="col-md-3">
                                    <input type="text" maxlength="30" class="form-control mb-3 mb-md-0" name="name" placeholder="Name" value="{{$request->name}}" onkeypress="return IsAlphaApos(event, this.value, '50')"> 
                                </div> 
                                <!-- <div class="col-md-3">
                                    <select name="order_by" class="form-control">
                                        <option value="">== Order By ==</option>
                                        <option {{ $request->order_by == 'DESC' ? 'selected' : ''}} value="DESC">OLD to NEW</option>
                                        <option {{ $request->order_by == 'ASC' ? 'selected' : ''}} value="ASC">NEW to OLD</option>
                                    </select>
                                </div>  -->
                                <div class="col-md-3 d-flex">
                                    <button class="btn btn-primary mr-3" type="submit">
                                        Filter
                                    </button>
                                    <button class="btn btn-danger" type="button" id="ClearFilter">
                                        Clear Filter
                                    </button>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4 table-hover">
                                <thead>
                                    <tr>
                                        <th>User Code</th>  
                                        <th>Name</th>   
                                        <th>Email</th>
                                        <th>Phone</th> 
                                        <th>Reg. Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($customer) > 0)
                                        @foreach($customer as $record)
                                            <tr>
                                                <td>{{$record->user_code}}</td>
                                                <td>{{$record->name}}</td>
                                                <td>{{$record->email}}</td>
                                                <td>{{$record->phone}}</td> 
                                                 <td>{{date('d F, Y', strtotime($record->created_at))}}</td>
                                                <td class="text-center">
                                                    <ul class="table-controls" style=" list-style-type: none;display: flex;"> 
                                                        <li><a href="{{route('customers.edit',base64_encode($record->user_id))}}"  data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit text-primary"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg></a></li>
                                                        <li><a onclick="return confirm('Are you sure you want to delete this?')" href="{{route('customers.delete',base64_encode($record->user_id))}}"  data-toggle="tooltip" data-placement="top" title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle text-danger"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></a></li> 
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr><td colspan="8" align="center"><strong>No record's found</strong></td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="paginating-container pagination-solid justify-content-end">
                            {{$customer->appends($request->all())->render('vendor.pagination.custom')}}
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection  