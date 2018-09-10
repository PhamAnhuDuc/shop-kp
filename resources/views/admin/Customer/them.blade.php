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
            @if(count($errors) >0)
                <div class="alert alert-danger">
                    @foreach($errors-> all() as $err )
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif

            @if(session('thongbao'))
            <div class="alert alert-success">
                {{session('thongbao')}}
            </div>
            @endif
            
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/customer/them" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Giới Tính</label>
                        <label class="radio-inline">
                            <input name="gender" value="0" checked="" type="radio">Nam
                        </label>
                        <label class="radio-inline">
                            <input name="gender" value="1" type="radio">Nữ
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" placeholder="email" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" name="address" placeholder="address" />
                    </div>
                    <div class="form-group">
                        <label>phone</label>
                        <input class="form-control" name="phone_number" placeholder="address" />
                    </div>
                    <div class="form-group">
                        <label>note</label>
                        <input class="form-control" name="note" placeholder="note" />
                    </div>
                    
                    <button type="submit" class="btn btn-default">Category Add</button>
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