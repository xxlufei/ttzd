(function (zd) {
    this.callWeChatPay = function(payCode){
        WeixinJSBridge.invoke('getBrandWCPayRequest', payCode,function(res){
            if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                alert('支付成功！开始享用吧！');
                window.location = '/goods_list?m='+__m;
            } else {
                alert(res.err_msg);
            }
        });
    };
    callWeChatPay(zd.store.get('payCode'));
})(ttzd);



