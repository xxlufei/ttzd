<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>天天早点</title>
    <link href="h5/css/common.css" rel="stylesheet" type="text/css">
    <link href="h5/css/style.css" rel="stylesheet" type="text/css">
    <script src="h5/js/jquery.min.js"></script>
</head>

<body>
<!-- header start -->
    <div class="header">
        <div class="title">
            天天早点
        </div>
        {{--<div class="banner" height="114px">
            <img src="h5/images/banner.jpg">
        </div>--}}
    </div>
    <!-- header end -->

    <!-- main start -->
    <div class="main">
        <!-- left-menu start -->
        <div class="left-menu" id="menu">
            <ul>
                @foreach($categorys as $category)
                <li @if ($loop->first) class="active"@endif categoryId="{{ $category->id }}">{{ $category->name }}</li>
                @endforeach
            </ul>
        </div>
        <!-- left-menu end -->

        <!-- con start -->
        <div class="con">
            <div class="right-con con-active">
                <ul id="goodsList">
                    @foreach($goods as $good)
                    <li style="display: @if($good->categoryid == $firstCategoryId) block @else none @endif" categoryId="{{ $good->categoryid }}" goodsId="{{ $good->id }}">
                        <div class="menu-img"><img src="{{ $good->imageurl }}" width="55" height="55"></div>
                        <div class="menu-txt">
                            <h4>{{ $good->name }}</h4>
                            <p class="list1">{{ $good->description }}</p>
                            <p class="list2">
                                @if($good->isdiscount == 'yes')
                                <b>￥{{ $good->discountprice/100 }}</b><s class="originalPrice">{{ $good->price/100 }}</s>
                                @else
                                    <b>￥{{ $good->price/100 }}</b>
                                @endif
                            </p>
                            @if($good->stock == 0)
                            <div class="btnOff">已售完</div>
                            <div class="btn"  style="display: none" >
                            @else
                            <div class="btn">
                            @endif
                                <button class="minus" style="display: none;" goodsId="{{ $good->id }}" price="{{ $good->isdiscount == 'yes' ? $good->discountprice : $good->price }}" stock="{{ $good->stock }}" name="{{ $good->name }}">
                                    <strong></strong>
                                </button>
                                <i style="display: none;" class="iCount">0</i>
                                <button class="add" goodsId="{{ $good->id }}" price="{{ $good->isdiscount == 'yes' ? $good->discountprice : $good->price }}" stock="{{ $good->stock }}" name="{{ $good->name }}">
                                    <strong></strong>
                                </button>
                                <i class="price">2</i>
                            </div>
                            <p></p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- con end -->
    </div>
    <!-- main end -->

    <!-- footer start -->
    <div class="footer">
        <!-- 未选购商品 start -->
        <!--<a class="cartShowBtn"><img src="h5/images/icon-cart-gray.png"></a>-->
        <!--<div class="left">-->
        <!--未选购商品-->
        <!--</div>-->
        <!-- 未选购商品 end -->

        <!-- 有选购商品 start -->
        <a class="cartShowBtn"><img src="h5/images/icon-cart.png"><i id="totalcountshow">0</i></a>
        <div class="left">
            ￥<span id="totalpriceshow">0.00</span>
        </div>
        <!-- 有选购商品 end -->

        <div class="right">
            <a id="submit" class="xhlbtn disable" href="javascript:void(0)">去结算</a>
        </div>
    </div>
    <!-- footer end -->

    <!-- 购物车点击显示列表层 start -->
    <div class="cartShowMode"></div>
    <div class="cartShowLayer">
        <p>已选商品</p>
        <div class="cartList">
            <ul>

            </ul>
        </div>
    </div>
    <!-- 购物车点击显示列表层 end -->

<script>
    var page_class = 'list';
</script>
<script type="text/javascript" src="h5/js/ttzd.js"></script>
<script type="text/javascript" src="h5/js/helper.js"></script>
<script type="text/javascript" src="h5/js/ttzd_store.js"></script>
<script type="text/javascript" src="h5/js/ttzd_io.js"></script>
<script type="text/javascript" src="h5/js/ttzd_page_cart.js"></script>

</body>
</html>