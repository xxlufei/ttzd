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
            @foreach($orderDetail as $order)
                <li class="active">
                    <br/>
                    {{ $order->goodsname }}　*　{{ $order->num }}　*　{{ $order->goodsprice/100 }}　=　¥{{ $order->num * $order->goodsprice/100 }}<br/>
                    <hr><br/>
                </li>
            @endforeach
        </ul>
    </div>
</div>

</body>
</html>