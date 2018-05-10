(function (zd) {
    var __cart = [];
    var __totalPrice = new Number(0);
    var __totalGoodsNum = 0;
    var $cartList = $('.cartList');
    var $goodsList = $('#goodsList');
    var $submit = $('#submit');
    var __submitIng = false;
    this.fillCart = function () {
        var str = '';
        for(var key in __cart){
            var iterm = __cart[key];
            if (iterm.num > 0) {
                str += '<li><span>'+iterm.name+'</span>' +
                    '<div class="btn">' +
                    '<button class="cartMinus" style="display: inline-block;" goodsId="'+iterm.id+'" price="'+iterm.price+'" stock="'+iterm.stock+'" name="'+iterm.name+'">' +
                    '<strong></strong>' +
                    '</button>' +
                    '    <i style="display: inline-block;">'+iterm.num+'</i>';
                str += '<button class="cartAdd" goodsId="'+iterm.id+'" price="'+iterm.price+'" stock="'+iterm.stock+'" name="'+iterm.name+'"';
                if (iterm.num == iterm.stock) {
                    str += 'style="display: none;"'
                }
                str +='>';
                str += '<strong></strong>' +
                    '</button>' +
                    '</div></li>';
            }
        }
        $cartList.html(str);
        bindCartAddMinusBtn();
    };
    // 购物车列表层显隐
    $('.cartShowBtn').on(EVENT_TAP, function() {
        $(".cartShowLayer").toggle();
        $(".cartShowMode").toggle();
    });

    $('.cartShowMode').on(EVENT_TAP,  function() {
        $(".cartShowLayer").toggle();
        $('.cartShowMode').toggle();
    });
    this.changeListLi = function (obj) {
        var li = $goodsList.find('li[goodsId="'+obj.id+'"]');
        li.find('.iCount').text(obj.num);
        if (obj.num == obj.stock) {
            li.find('.add').hide();
        } else if (obj.num == 0) {
            li.find('.add').prevAll().hide();
            li.find('.add').css('display','inline-block')
        }
    };
    this.bindCartAddMinusBtn = function () {
        // 加的效果
        $(".cartAdd").off(EVENT_TAP);
        $(".cartMinus").off(EVENT_TAP);
        $(".cartAdd").on(EVENT_TAP, function () {
            var stock = $(this).attr('stock');
            var goodsId = $(this).attr('goodsId');
            var name = $(this).attr('name');
            var cartKey = 'goods_'+ goodsId;
            if (__cart[cartKey] && __cart[cartKey].num + 1 > stock) {
                return;
            }
            var price = parseInt($(this).attr('price'));
            __cart[cartKey].num += 1;
            if (__cart[cartKey].num == stock) {
                $(this).css("display", "none");
            }
            $(this).prev().text(__cart[cartKey].num);
            __totalGoodsNum += 1;
            __totalPrice += price;
            fiexdAllNum();
            changeListLi(__cart[cartKey]);
            jss();  // 改变按钮样式
        });
        // 减的效果
        $(".cartMinus").on(EVENT_TAP, function () {
            var stock = $(this).attr('stock');
            var goodsId = $(this).attr('goodsId');
            var cartKey = 'goods_'+ goodsId;
            if (__cart[cartKey].num == 0) {
                $(this).parent().parent().remove();
                return;
            }
            if (stock != 0) {
                $(this).next().next().show();
            }
            var price = parseInt($(this).attr('price'));
            __cart[cartKey].num -= 1;
            __totalGoodsNum -= 1;
            __totalPrice -= price;
            $(this).next().text(__cart[cartKey].num);
            changeListLi(__cart[cartKey]);
            fiexdAllNum();
            if (__cart[cartKey].num == 0) {
                $(this).parent().parent().remove();
            }
            jss();
        });
    };

    this.bindAddMinusBtn = function () {
        // 加的效果
        $(".add").off(EVENT_TAP);
        $(".minus").off(EVENT_TAP);
        $(".add").on(EVENT_TAP, function () {
            var stock = $(this).attr('stock');
            var goodsId = $(this).attr('goodsId');
            var name = $(this).attr('name');
            var inlist = $(this).attr('inlist');
            var cartKey = 'goods_'+ goodsId;
            if (__cart[cartKey] && __cart[cartKey].num + 1 > stock) {
                return;
            }
            var price = parseInt($(this).attr('price'));
            if (__cart[cartKey]) {
                __cart[cartKey].num += 1;
            } else {
                __cart[cartKey] = {num:0, id:0, name:'', stock:0, price:0};
                __cart[cartKey].num = 1;
                __cart[cartKey].id  = goodsId;
                __cart[cartKey].name = name;
                __cart[cartKey].stock = stock;
                __cart[cartKey].price = price;
            }
            if (__cart[cartKey].num == 1) {
                $(this).prevAll().css("display", "inline-block");
            }
            if (__cart[cartKey].num == stock) {
                $(this).css("display", "none");
            }
            $(this).prev().text(__cart[cartKey].num);
            __totalGoodsNum += 1;
            __totalPrice += price;
            fiexdAllNum();
            fillCart();
            jss();  // 改变按钮样式
        });
        // 减的效果
        $(".minus").on(EVENT_TAP, function () {
            var stock = $(this).attr('stock');
            var goodsId = $(this).attr('goodsId');
            var inlist = $(this).attr('inlist');

            var cartKey = 'goods_'+ goodsId;

            if (__cart[cartKey].num == 0) {
                return;
            }
            var price = parseInt($(this).attr('price'));
            __cart[cartKey].num -= 1;
            if (__cart[cartKey].num == 0) {
                $(this).hide();
                $(this).next().hide();
            }
            if (stock != 0) {
                $(this).next().next().show();
            }
            $(this).next().text(__cart[cartKey].num);
            __totalGoodsNum -= 1;
            __totalPrice -= price;
            fillCart();
            fiexdAllNum();
            jss();
        });
    };
    bindAddMinusBtn();


    this.fiexdAllNum = function () {
        $("#totalpriceshow").html((__totalPrice/100).toFixed(2));
        $("#totalcountshow").html(__totalGoodsNum);
    };
    $(".left-menu li").on(EVENT_TAP, function(){
        $('.right-con').find("li").siblings().hide();
        $("li[categoryId="+ $(this).attr('categoryId') +"]").show();
        $(this).addClass("active").siblings().removeClass("active");
    });
    // 重置内容区大小
    resizeMain();
    $(window).resize(function() {
        resizeMain();
    });
    // 重置MAIN区大小
    function resizeMain() {
        var headerHeight = 43;
        var footerHeight = $(".footer").height();
        var newHeight = $(window).height() - headerHeight - footerHeight;
        $(".main").css({
            "height": newHeight,
            "position": "absolute",
            "top": headerHeight,
            "bottom": footerHeight,
            "left": 0,
            "right": 0
        });
        $(".left-menu").css({
            "height": newHeight
        });
        $(".right-con").css({
            "height": newHeight
        });
        $(".cartShowLayer").css({
            "bottom": footerHeight
        });
    }
    this.orderSubmit_callback = function (datas) {
        if (datas.status == 200) {
            window.location = '/order_book?orderId='+datas.content.orderId+'&orderNo='+datas.content.orderNo;
        } else {
            alert(datas.msg);
            location.reload();
        }
    };
    this.orderSubmit = function () {
        __submitIng = true;
        var submitArr = [];
        for(var key in __cart) {
            submitArr.push({id : __cart[key].id, num : __cart[key].num});
        }
        zd.api.order.submit(jsonEncode(submitArr), 'orderSubmit_callback')
    };
    this.bindSubmitBtn = function () {
        $(".right").find("a").removeClass("disable");
        $submit.off(EVENT_TAP);
        $submit.on(EVENT_TAP, function () {

            //if (__submitIng)
            //    return false;
            orderSubmit();
        });
    };
    this.deBindSubmitBtn = function () {
        $(".right").find("a").addClass("disable");
        $submit.off(EVENT_TAP);
    };
    function jss() {
        if (__totalGoodsNum > 0) {
            bindSubmitBtn();
        } else {
            deBindSubmitBtn();
        }
    }

})(ttzd);



