<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <title>天天早点</title>
    <link rel="stylesheet" type="text/css" href="h5/css/api.css"/>
    <link rel="stylesheet" type="text/css" href="h5/css/common.css?v=7"/>
    <link rel="stylesheet" type="text/css" href="h5/css/goods-two.css"/>
    <script src="h5/js/jquery.min.js"></script>
</head>
<body style="background-color:#fff">
<div id="wrap1">
    <div id="header" style="background-color: #458ae7;">
    </div>
    <div class="shop" style="background-color: #458ae7;">
        <div class="shopheader-main">
            <h2 class="shopheader-name">天天早点</h2>
        </div>
    </div>
</div>
<div id="menu-tabs-container">
    <div class="j-menu-tabs menu-tabs">
        <a class="tab1" href="javascript:void(0);">
            <span>你好大兄弟</span>
        </a>

    </div>
</div>
<div id="asidewrap" class="asidewrap">
    <div class="taglist">
        @foreach($categorys as $category)
        <div class="j-tag tag @if ($loop->first) focus @endif" style=" margin-top:0px;" categoryId="{{ $category->id }}">
            <div class="tag-inner">
                <span class="tag-text">{{ $category->name }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div id="mainwrap" class="mainwrap">
    <div class="foodlistwrap" style="padding-top:10px;">
        <h3 class="foodlist-label"></h3>
        <ul>
            @foreach($goods as $good)
            <li class="j-fooditem fooditem">
                <div class="food-content1 clearfix" dishid="" dthumb=""
                     dprice=""
                     dunitname=""
                     dsales="">
                    <div class="food-pic-wrap open-popup" data-target="#full">
                        <img class="j-food-pic food-pic goodsthumb lazy"
                             data-original="" src="images/dsb.jpg"/>
                    </div>
                    <div class="food-cont">
                        <div class="j-foodname foodname " data-target="#full">{{ $good->name }}</div>
                        <div class="food-desc" data-target="#full">{{ $good->description }}</div>
                        <div class="food-content1-sub " data-target="#full">
                            <span>已售 {{ $good->soldnum }}</span>
                        </div>
                        <div class="j-item-console foodop clearfix">
                            <a class="j-add-item add-food" href="javascript:;">
                                <i class="icon i-add-food j-add-inner"></i>
                            </a>
                            <span class="j-item-num foodop-num">1</span>
                            <a class="j-remove-item remove-food">
                                <i class="icon i-remove-food"></i>
                            </a>
                        </div>
                        <div class="food-price-region" data-target="#full">
                            @if($good->isdiscount == 'yes')
                            <span class="food-price">会员:¥{{ $good->discountprice }}</span>
                            <br>
                            <span class="food-price">原价:¥
                                <del>{{ $good->discountprice }}</del>
                           </span>
                            @else
                            <span class="food-price">单价:¥{{ $good->price }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div id="cart" class="cart">
    <div class="cart-tip">
        <div class="j-cart-icon cart-icon ico-cart-active">
            <i class="j-ico-cart ico-cart ico-cart-active" id="add-cart"></i>
            <div class="j-cart-num cart-num" style="display: block;"></div>
        </div>
        <div class="j-cart-noempty cart-noempty" style="display: block;">
            <span class="j-cart-price cart-price">共 ￥<font>14</font></span>
            <del class="j-cart-origin cart-origin">15</del>
        </div>
    </div>
    <div class="cart-btns">
        <a class="j-cart-btn-confirm cart-btn-confirm" style="display:
        block;" href="javascript:;">
            <span class="inner" onclick="btnSelectJump();">我选好了</span>
        </a>
        <a class="j-cart-btn-unavail cart-btn-unavail" style="display:none">
            <span class="inner">购物中</span>
        </a>
    </div>
</div>

<!--购物车列表-->
<div class="shop-cart"></div>
<div class="cart-list">
    <div class="cart-header">
        <i class="cart-b">
            <div class="cart-n">66</div>
        </i>
    </div>
    <div class="popup-cart-actions">
        <button class="button popup-cart-clear-btn">清空</button>
        <span>购物车</span>
    </div>
    <div class="native-scroll">
        <ul>

            <li dishid="{$item['goodsid']}">
                <div class="cart-item-name">旺仔小馒头</div>
                <div class="cart-item-price">¥<font>11</font></div>
                <div class="cart-item-num">
                    <i class="cart-item-add"></i>
                    <span>73</span>
                    <i class="cart-item-jj"></i>
                </div>
            </li>
        </ul>
    </div>
    <div class="cart-footer">
        <div class="cart-fl">
            共 ￥<strong>13</strong>
        </div>
        <button class="btn1" onclick="btnSelectJump();">我选好了</button>
        <button class="btn2" style="background-color: #a0a0a0;display: block;">我选好了</button>
    </div>
</div>
<div class="top-btn" style="display: block;">
    <a class="react">
        <i class="text-icon">⇧</i>
    </a>
</div>
<script>
    $(document).scroll(function () {
        var ftop = $(document).scrollTop();
        var cate = 3; //菜单栏个数
        for (var i = 1; i < cate; i++) {
            var fheighti = $('.foodlistwrap h3').eq(i).offset();
            var hi = fheighti.top - 285;
            if (ftop > hi) {
                $('.tag').removeClass('focus')
                $('.tag').eq(i).addClass('focus')
            }
            if (i == 1) {
                if (ftop < hi) {
                    $('.tag').removeClass('focus')
                    $('.tag').eq(0).addClass('focus')
                }
            }
        }
    });
    //top行为
    $('.top-btn').on('click', function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    });
    if ($(document).scrollTop() == 0) {
        $('.top-btn').css('display', 'none');
    }
    $(document).bind('scroll', function () {
        if ($(document).scrollTop() == 0) {
            $('.top-btn').css('display', 'none');
        } else {
            $('.top-btn').css('display', 'block');
        }
    })

    $('.shopheader-activity-count').on('click', function () {
        $('.top-btn2').toggle(200)
    });
</script>



</body>
</html>
