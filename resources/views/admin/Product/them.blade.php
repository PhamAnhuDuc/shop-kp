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
                    @foreach($errors-> all() as $err)
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
                <form action="admin/product/them" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> Name</label>
                        <input class="form-control" name="name" placeholder="Nhập Name" />
                    </div>
                    {{-- <div class="form-group">
                        <label>ID Type</label>
                        <input class="form-control" name="id_type" placeholder="Nhập id_type" />
                    </div> --}}
                    <div class="form-group">
                        <label> Loại San Pham</label>
                        <select class="form-control" name="TheLoai">
                            @foreach($productType as $key => $value)
                            <option value="{{ $value ->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nhập Description</label>
                        <textarea  id="demo" class="form-control ckeditor" rows="3" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nhập giá unit_price</label>
                        <input class="form-control" name="unit_price" placeholder="Nhập unit_price" />
                    </div>
                    <div class="form-group">
                        <label>Nhập giá promotion_price</label>
                        <input class="form-control" name="promotion_price" placeholder="Nhập promotion_price" />
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="img" placeholder="chọn hình ảnh" />
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select class="form-control" name="unit">
                            <option value="hộp" name="hop">Hộp</option>
                            <option value="cái" name="cai">Cái</option>
                        </select>
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