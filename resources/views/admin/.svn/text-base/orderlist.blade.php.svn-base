<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>天天早点</title>
    <link href="../h5/css/common.css" rel="stylesheet" type="text/css">
    <link href="../h5/css/style.css" rel="stylesheet" type="text/css">
    <script src="../h5/js/jquery.min.js"></script>
</head>

<body>
<div class="main">
    <div id="menu">
        <ul>
            @foreach($orders as $order)
                <li class="active">
                    订单ID: {{ $order->id }}<br/>
                    微信订单号: {{ $order->wxorderno }}<br/>
                    支付金额: {{ $order->payprice/100 }}<br/>
                    收货人: {{ $order->receiver }}<br/>
                    电话: {{ $order->mobile }}<br/>
                    地址: {{ $order->address }}<br/>
                    <a href="/ad/orderdetail/?orderId={{ $order->id }}" style="color: blue;">详情</a>
                    <br/><hr><br/>
                </li>
            @endforeach
        </ul>
    </div>
</div>

</body>
</html>