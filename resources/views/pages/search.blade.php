@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Tìm Kiếm</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm Thấy {{count($product)}} Sản Phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                        	@foreach ($product as $new)
                            	@include('product-foreach-search')
                            @endforeach
                        </div>    
                 		<div class="row">{{ $product->appends(Request::all())->links() }}﻿</div>
                    </div> <!-- .beta-products-list -->
                    <div class="space50">&nbsp;</div>
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
@endsection