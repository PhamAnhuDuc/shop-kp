@extends('admin.layout.index')
<!-- Page Content -->
@section('content-admin')
    <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Category
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach( $errors->all() as $err)
                                {{$err}}
                            @endforeach
                        </div>
                    @endif
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <div class="col-lg-7" style="padding-bottom:120px"  >
                <form action="admin/producttype/them" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-group">
                        <label>Ten Loai San Pham </label>
                        <input class="form-control" name="name" placeholder="nhập Name" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input class="form-control" name="description" placeholder="nhập description" />
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="img" placeholder="chọn hình ảnh" />
                    </div>
                    <button type="submit" class="btn btn-default"> Add</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

<!-- /#page-wrapper -->