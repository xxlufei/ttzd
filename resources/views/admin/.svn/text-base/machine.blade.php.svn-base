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
            新增 : <li class="active" machineId="">机器位置: <input type="text" value="" ><span>提交</span></li><br >
            <hr>
            编辑 :
            <ul>
                @foreach($machines as $machine)
                    <li class="active" machineId="{{ $machine->id }}">机器ID:{{ $machine->id }}　机器位置: <input type="text" value="{{ $machine->location }}" ><br><br><span>提交</span>　||　<del>删除</del><br><br/><a
                                href="/ad/category?machineId={{ $machine->id }}">编辑分类</a> || <a
                                href="/ad/goods?machineId={{ $machine->id }}">编辑商品</a></li>
                    <hr>
                @endforeach
            </ul>
        </div>
    </div>


<script>
    var page_class = 'list';
</script>
<script type="text/javascript" src="../h5/js/ttzd.js"></script>
<script type="text/javascript" src="../h5/js/helper.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_store.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_io.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_page_machine.js"></script>

</body>
</html>