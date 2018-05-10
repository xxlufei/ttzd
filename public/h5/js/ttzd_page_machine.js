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
        var location = li.find('input').val();
        var id = li.attr('machineId');
        zd.api.order.submitMachine(id, location, 'submit_callback');
    })
    $li.find('del').on(EVENT_TAP, function () {
        var li = $(this).parent();
        zd.api.admin.remove('machine', li.attr('machineId'), 'submit_callback');
    });
})(ttzd);



