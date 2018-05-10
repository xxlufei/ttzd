(function (zd) {
    var $li = $('li');
    var $imgUploadInput = $('input[name="img"]');
    var __nowIndex = 0;
    var __maxImgSize = 20 * 1024;
    var __file = {};
    var __goodsPic = '';
    this.submit_callback = function (datas) {
        if (datas.status == 200) {
            alert('操作成功!');
            location.reload();
        } else {
            alert(datas.msg);
        }
    };
    $li.find('del').on(EVENT_TAP, function () {
        var li = $(this).parent();
        zd.api.admin.remove('goods', li.attr('goodsId'), 'submit_callback');
    });
    $li.find('span').on(EVENT_TAP, function () {
        var li = $(this).parent();
        var name = li.find('textarea[name="name"]').val();
        var categoryId = li.find('input[name="categoryId"]').val();
        var price = li.find('input[name="price"]').val();
        var sort = li.find('input[name="sort"]').val();
        var machineId = li.attr('machineId');
        var goodsId = li.attr('goodsId');
        zd.api.admin.submitGoods(name, categoryId, price, machineId, goodsId, __goodsPic, sort, 'submit_callback');
    });
    $li.find('div').on(EVENT_TAP, function () {
        var li = $(this).parent();
        __nowIndex = li.prevAll().length;
    });

    this.startUploadImg = function () {
        var formData = new FormData();
        formData.append("Filedata", __file);
        $.ajax({
            url: '/ad/goodspicup',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log("uploading...");
            },
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status !== 200) {
                    alert(result.msg);
                } else {
                    __goodsPic = result.content.path;console.log(__goodsPic)
                }
            },
            error: function (responseStr) {
                xz.ui.message('图片上传失败；请重新上传');
            }
        });
    };
    this.bindImgUploadInputChange = function () {
        $imgUploadInput.on('change', function () {
            __file = document.getElementsByName("img")[__nowIndex].files[0];
            var reader = new FileReader();
            reader.onloadend = function () {
                var img = new Image();
                img.addEventListener("load", imgLoaded, false);
                img.src = reader.result;
                function imgLoaded() {
                    startUploadImg();
                }
            };
            if (__file) {
                if (!checkImg(__file)) {
                    alert('请您上传大小不超过20k的照片。');
                } else {
                    reader.readAsDataURL(__file);
                }
            }
        });
    };
    bindImgUploadInputChange();
    this.checkImg = function (file) {
        var str = 'gif|jpg|jpeg|png';
        var mime = file.type.substring(file.type.indexOf('/') + 1);
        if (str.indexOf(mime) === -1 || mime == '' || file.size > __maxImgSize) {
            return false;
        } else {
            return true;
        }
    };
})(ttzd);



