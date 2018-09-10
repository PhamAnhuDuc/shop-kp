@extends('admin.layout.index')
<!-- Page Content -->
@section('content-admin')
    <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Them</small>
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
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/slide/them" method="POST" enctype="multipart/form-data"> <!--upload file can truong nay-->
                    @csrf
                    <div class="form-group">
                        <label>Ten</label>
                        <input class="form-control" name="ten" placeholder="nhap ten slide" />
                    </div>
                    <div class="form-group">
                        <label>link</label>
                        <input class="form-control" name="link" placeholder="nhap link" />
                    </div>
                    <div class="form-group">
                        <label>Hinh anh </label>
                        <input type="file" class="form-control" name="Hinh"  />
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