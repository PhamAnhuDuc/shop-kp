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
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            @csrf
                            <div class="form-group">
                            <label>Họ Tên</label>
                            <input class="form-control" name="hoten" value="{{$user->full_name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <label>SĐT</label>
                                <input class="form-control" name="phone" value="{{$user->phone}}" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Đổi Mật khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="nhập mật khẩu"  disabled="disabled" />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Password</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="{{$user->address}}" />
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
<!-- Page Content -->

@section('script-admin')
    {{-- expr --}}
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){ //bat su kien change
                if($(this).is(":checked")){ //kiem tra xem co thuoc tinh nay ko
                    $('.password').removeAttr('disabled'); //co thi remove no di
                }else{
                     $('.password').attr('disabled','');   // ko thi add cho no
                }
            });
        });
    </script>
@endsection


