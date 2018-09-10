@extends('master')
@section('content')
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer" >
                <div class="banner" >
                    <ul>
                        @foreach ($slide as $sl => $value)
                            <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
                                <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                                    <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" 
                                src="source/image/slide/{{$value->image}}" data-src="source/image/slide/{{$value->image}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat;
                                    background-image: url('source/image/slide/{{$value->image}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->
</div>
<div class="container">
    <div id="content" class="space-top-none">
        <div class="main-content">
            <div class="space60">&nbsp;</div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="beta-products-list">
                        <h4>Sản Phẩm Mới</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm Thấy {{count($new_product)}} Sản Phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($new_product as $new)
                                @include('product-foreach-search')
                            @endforeach
                        </div>    
                    <div class="row">{{$new_product->links()}}</div>
                    </div> <!-- .beta-products-list -->

                    <div class="space50">&nbsp;</div>

                    <div class="beta-products-list">
                        <h4>Sản Phẩm khuyển mãi</h4>
                        <div class="beta-products-details">
                            <p class="pull-left">Tìm Thấy {{count($sanpham_khuyenmai)}} Sản Phẩm</p>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row">
                            @foreach ($sanpham_khuyenmai as $new)
                                @include('product-foreach-search')
                            @endforeach
                        </div>
                        <div class="row">
                            {{$sanpham_khuyenmai->links()}}
                        </div>
                        <div class="space40">&nbsp;</div>
                    </div> <!-- .beta-products-list -->
                </div>
            </div> <!-- end section with sidebar and main content -->
        </div> <!-- .main-content -->
    </div> <!-- #content -->
@endsection

@section('script')
    <script>
        function add(id, name){
            //var a = jQuery(this).attr('value');
            //alert(id);
            jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
            });
            jQuery.ajax({
                url : "addToCart/"+ id,
                type: "get",
                data        : {title: "Bạn ĐÃ thêm thành công"},
                dataType    : "html", 
                success     : function(data){
                                //console.log(data);
                                var obj = JSON.parse(data);
                                //console.log(obj);
                                var text='';
                                var total_product= obj[1];
                                var total_price = obj[2];
                                console.log(obj);
                                jQuery.each(obj[0], function( key, value){
                                            var total_price = value.qty * value.price ;
                                            
                                            text += '<div class="cart-item">'+
                                                '<a href="http://localhost:8080/framewok/shop/public/del-cart/6e43d2a63e40e917d5013f6e545c76df" class="cart-item-delete"><i class="fa fa-times"></i></a>'+
                                                '<div class="media">'+
                                                '<a class="pull-left" href="#"><img src="source/image/product/'+value.options.img+'" alt=""></a>'+
                                                '<div class="media-body">'+
                                                '<span class="cart-item-title">'+value.name+'</span>'+
                                                '<span class="cart-item-amount">'+ value.qty+'*<span>'+ value.price+
                                                '</span></span>'+
                                                '</div>'+
                                                '</div>'+
                                                '</div>';

                                });
                                    jQuery("#giohang").html('').append(text);
                                    jQuery("#total").html(total_product);     
                                    jQuery("#tongtien").html('').append(total_price);            
                            },  
            })
            alert('Đã Thêm Vào Giỏ Hàng');
        }
    </script>
@endsection

