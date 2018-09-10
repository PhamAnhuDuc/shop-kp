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
            <div class="col-lg-7" style="padding-bottom:120px">
                <form action="admin/user/them" method="post">
                    @if(count($errors ) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                    {{ $err }}
                                @endforeach
                            </div>
                        @endif

                    @if (Session::has('thongbao'))
                        <div class="alert alert-success">{{Session::get('thongbao')}}</div> 
                    @endif
                
                    @csrf
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="hoten" placeholder="nhập tên" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="nhập địa chỉ email" />
                    </div>
                    <div class="form-group">
                        <label>SĐT</label>
                        <input class="form-control" name="phone" placeholder="nhập số điện thoại" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Nhập Lại Password</label>
                        <input type="password" class="form-control" name="passwordAgain" placeholder="nhập mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="nhập địa chỉ" />
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