@extends('admin.layout.index')
@section('content-admin')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                {{-- <th>ID Type</th> --}}
                                <th>Description</th>
                                <th>Unit_price</th>
                                <th>Promotion_price</th>
                                <th>image</th>
                                <th>Unit</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $key => $value)
                                <tr class="odd gradeX" align="center">
                                <td>{{ $value->id}}</td>
                                <td>{{ $value->name}}</td>
                                {{-- <td>{{ $value->id_type}}</td> --}}
                                <td>{{ $value->description}}</td>
                                <td>{{ $value->unit_price}}</td>
                                <td>{{ $value->promotion_price}}</td>
                                <td><img src="source/image/product/{{$value->image}}" alt="" width="200px" height="100px;"></td>
                                <td>{{ $value->unit }}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/product/xoa/{{$value->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product/sua/{{$value->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection