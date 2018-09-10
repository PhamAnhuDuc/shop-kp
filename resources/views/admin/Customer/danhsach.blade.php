@extends('admin.layout.index')
@section('content-admin')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Customer
                            <small>customer</small>
                        </h1>
                    </div>
                        @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                        @endif
                        @if(count($errors) >0)
                            <div class="alert alert-danger">
                                @foreach($errors-> all() as $err )
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>email</th>
                                <th>address</th>
                                <th>phone_number</th>
                                <th>note</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $key => $value)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->gender}}</td>
                                    <td>{{$value->email}}</td>
                                    <td>{{$value->address}}</td>
                                    <td>{{$value->phone_number}}</td>
                                    <td>{{$value->note}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/customer/xoa/{{$value->id}}" class="comfil-delete"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/customer/sua/{{$value->id}}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection