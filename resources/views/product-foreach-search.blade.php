<div class="col-sm-3">
    <div class="single-item" id="tmp{{$new->id}}">
        @if ($new->promotion_price != 0)
            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
        @endif
        <div class="single-item-header">
            <a href="{{route('chitietsanpham',$new->id)}}"><img src="source/image/product/{{$new->image}}" alt="" width="270px" height="320px"></a>
        </div>
        <div class="single-item-body">
            <p class="single-item-title">{{$new->name }}</p>
            <p class="single-item-price">
                @if ($new->promotion_price == 0)
                    <span class="flash-del">{{number_format($new->unit_price) }}</span>
                @else
                    <span class="flash-del">{{number_format($new->unit_price) }}</span>
                    <span class="flash-sale">{{number_format($new->promotion_price) }}</span>
                @endif
            </p>
        </div>
        <div class="single-item-caption">
            <a class="add-to-cart pull-left"  onclick="add({{$new->id}}, '{{$new->name}}')" id="addCart1" ><i class="fa fa-shopping-cart"></i></a>
            <a class="beta-btn primary"        href="{{route('chitietsanpham',$new->id)}}">Details <i class="fa fa-chevron-right"></i></a>
            <div class="clearfix"></div>
        </div>
        {{-- <div id="xacnhan{{$new->id}}"></div> --}}
    </div>
</div>

{{--"onclick="add({{$new->id}}, '{{$new->name}}')--}}
{{--href="{{ route('themgiohang',$new->id )}}"--}}