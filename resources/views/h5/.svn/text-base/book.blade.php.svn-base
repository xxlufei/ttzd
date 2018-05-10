<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>订单支付</title>
    <link href="h5/css/common.css" rel="stylesheet" type="text/css">
    <link href="h5/css/book.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="h5/js/jquery.min.js"></script>
</head>

<body>
<!-- header start -->
<div class="list_top">
    <div class="title">
        天天早点
    </div>
</div>
<!-- header end -->

<!-- main start -->
<div class="container">
    <div class="box">
        <div class="box_con">
            <p class="box_title">收货地址</p>
            <ul>
                <li>
                    <span>预订人：</span><input type="text" name="nickname" value="@if($address){{ $address->receiver }}@endif">
                </li>
                <li>
                    <span>电话：</span><input type="text" name="mobile" value="@if($address){{ $address->mobile }}@endif">
                </li>
                <li>
                    <span>地址：</span><input type="text" name="address" value="@if($address){{ $address->address }}@endif">
                </li>
            </ul>
        </div>
    </div>
    <!-- 订单 start -->
    <div class="orderBox" style="padding-top: 20px;">
        <p class="order_num">订单编号 {{ $orderNo }}   <span style="float: right" id="cancel">重新下单</span></p>
        <p class="order_num"><span style="float: right;color: red">请在3分钟内完成支付</span></p>
        <table>
            @foreach($goods as $g)
            <tr>
                <td><b>{{ $g['name'] }}</b></td>
                <td><em>*{{ $g['num'] }}</em></td>
                <td><span>￥{{ $g['price'] }}</span></td>
            </tr>
            @endforeach
        </table>
    </div>
    <!-- 订单 end -->
</div>
<!-- main end -->

<!-- footer start -->
<div class="footer">
    <div class="left">
        ￥<span id="totalpriceshow">{{ $totalPrice }}</span>
    </div>

    <div class="right">
        <a id="pay" class="xhlbtn" href="javascript:void(0)">支付</a>
    </div>
    <div style="display: none" id="info" orderId="{{ $orderId }}" orderNo="{{ $orderNo }}" m="{{ $m }}"></div>
</div>
<!-- footer end -->
<script type="text/javascript" src="h5/js/ttzd.js"></script>
<script type="text/javascript" src="h5/js/helper.js"></script>
<script type="text/javascript" src="h5/js/ttzd_store.js"></script>
<script type="text/javascript" src="h5/js/ttzd_io.js"></script>
<script type="text/javascript" src="h5/js/ttzd_page_book.js"></script>
</body>
</html>