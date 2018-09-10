@extends('admin.layout.index')

@section('content-admin')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <div class="col-lg-7" style="padding-bottom:120px">
                            <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data"> <!--upload file can truong nay-->
                                @csrf
                                
                                <div class="form-group">
                                    <label>link</label>
                                    <input class="form-control" name="link" placeholder="nhap link" value="{{$slide->link}}" />
                                </div>
                                <div class="form-group">
                                    <label>Hinh anh </label>
                                    <p><img width="500px" src="source/image/slide/{{$slide->image}}" alt=""></p>
                                    <input type="file" class="form-control" name="Hinh"  />
                                </div>
                               
                                <button type="submit" class="btn btn-default"> Sửa</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
<!-- Page Content -->
        
        <!-- /#page-wrapper -->