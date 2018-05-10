(function (zd) {
    var $li = $('li');
    this.submit_callback = function (datas) {
        if (datas.status == 200) {
            alert('操作成功!');
            location.reload();
        } else {
            alert(datas.msg);
        }
    };
    $li.find('span').on(EVENT_TAP, function () {
        var li = $(this).parent();
        var name = li.find('input[name="name"]').val();
        var machineId = li.attr('machineId');
        var categoryId = li.attr('categoryId');
        var sort = li.find('input[name="sort"]').val();
        zd.api.admin.submitCategory(name, categoryId, machineId, sort, 'submit_callback');
    });
    $li.find('del').on(EVENT_TAP, function () {
        var li = $(this).parent();
        zd.api.admin.remove('category', li.attr('categoryId'), 'submit_callback');
    });
})(ttzd);



