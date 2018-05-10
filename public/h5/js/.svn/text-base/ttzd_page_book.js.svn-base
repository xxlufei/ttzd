(function (zd) {
    var $info = $('#info');
    var __orderId = $info.attr('orderId');
    var __orderNo = $info.attr('orderNo');
    var __m = $info.attr('m');
    var $pay = $('#pay');

    var __nickname = $('input[name="nickname"]').val();
    var __mobile = $('input[name="mobile"]').val();
    var __address = $('input[name="address"]').val();

    this.bindPayBtn = function () {
        $pay.removeClass('disable');
        $pay.off(EVENT_TAP);
        $pay.one(EVENT_TAP, function () {
            if (!__nickname || !__mobile || !__address) {
                alert('请填写地址信息');
                deBindPayBtn();
                return false;
            }
            zd.api.order.pay(__orderId, __orderNo, __nickname, __mobile, __address, 'orderPay_callback');
        });
    };
    this.deBindPayBtn = function () {
        $pay.addClass('disable');
        $pay.off(EVENT_TAP);
    };

    this.getWxPayInfo_callback = function (datas) {
        if (datas.status == 200) {
            alert('支付成功!开始享用吧!');
            window.location = '/goods_list?m='+__m;
        } else {
            alert(datas.msg);
            location.reload();
        }
    };

    this.callWeChatPay = function(payCode){
        WeixinJSBridge.invoke('getBrandWCPayRequest', payCode,function(res){
            zd.api.order.getWxPayInfo(__orderId, __orderNo, 'getWxPayInfo_callback');
        });
    };

    this.orderPay_callback = function (datas) {
        if (datas.status == 200) {
            callWeChatPay(JSON.parse(datas.content.payCode));
        } else {
            alert(datas.msg);
        }
    };
    this.submitCheck = function () {
        if (__nickname && __mobile && __address) {
            bindPayBtn();
        } else {
            deBindPayBtn();
        }
    };
    submitCheck();
    
    $('input').on('change blur keyup', function () {
        __nickname = $('input[name="nickname"]').val();
        __mobile = $('input[name="mobile"]').val();
        __address = $('input[name="address"]').val();
        submitCheck();
    });

    this.orderCancel_callback = function (datas) {
        if (datas.status == 200) {
            alert('订单取消成功');
            window.location = '/goods_list?m='+__m;
        } else {
            alert(datas.msg);
            window.location = '/goods_list?m='+__m;
        }
    };
    $('#cancel').one(EVENT_TAP, function () {
        zd.api.order.cancel(__orderId, 'orderCancel_callback');
    });
})(ttzd);



