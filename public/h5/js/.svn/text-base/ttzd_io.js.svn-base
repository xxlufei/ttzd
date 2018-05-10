(function (zd) {
    zd.api={order:{}, admin:{}};
    __api = window.location.protocol + '//' + window.location.host + '/';
    zd.api.get = function(module, datas, jsonp, succ, error) {
        datas['jsonp']     = jsonp;
        datas['timestamp'] = new Date().getTime();
        var req = $.ajax({
            type     : 'GET',
            url      : __api + module,
            dataType : jsonp != '' ? 'jsonp' : 'json',
            async    : true,
            jsonpCallback : jsonp,
            data     : datas,
        }).done(succ).fail(function(xhr,msg){
            console.log(msg);
            console.log(xhr);
            console.log(__api + module);
            console.log(datas);
            if (error) error();
        });//.done(succ).fail(error);
    }
    zd.api.order.submit =  function(params, jsonp, succ, error) {
        zd.api.get('order_submit', {
            'params'  : params
        }, jsonp, succ, error);
    };
    zd.api.order.cancel =  function(orderId, jsonp, succ, error) {
        zd.api.get('order_cancel', {
            'orderId'  : orderId
        }, jsonp, succ, error);
    };
    zd.api.order.pay =  function(orderId, orderNo, __nickname, __mobile, __address, jsonp, succ, error) {
        zd.api.get('order_pay', {
            'orderId'  : orderId,
            'orderNo'  : orderNo,
            'nickname'  : __nickname,
            'mobile'  : __mobile,
            'address'  : __address
        }, jsonp, succ, error);
    };
    zd.api.order.getWxPayInfo =  function(orderId, orderNo, jsonp, succ, error) {
        zd.api.get('order_getWxPayInfo', {
            'orderId'  : orderId,
            'orderNo'  : orderNo
        }, jsonp, succ, error);
    };
    zd.api.order.submitMachine =  function(id, location, jsonp, succ, error) {
        zd.api.get('ad/submitMachine', {
            'id'  : id,
            'location'  : location
        }, jsonp, succ, error);
    };
    zd.api.admin.submitGoods =  function(name, categoryId, price, machineId, goodsId, __goodsPic, sort, jsonp, succ, error) {
        zd.api.get('ad/submitGoods', {
            name : name,
            categoryId : categoryId,
            price : price,
            machineId : machineId,
            goodsId : goodsId,
            imageUrl : __goodsPic,
            sort : sort
        }, jsonp, succ, error);
    };
    zd.api.admin.submitCategory =  function(name, categoryId, machineId, sort, jsonp, succ, error) {
        zd.api.get('ad/submitCategory', {
            name : name,
            categoryId : categoryId,
            machineId : machineId,
            sort : sort,
        }, jsonp, succ, error);
    };
    zd.api.admin.remove =  function(type, id, jsonp, succ, error) {
        zd.api.get('ad/remove', {
            type : type,
            id : id
        }, jsonp, succ, error);
    };
})(ttzd);