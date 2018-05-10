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
                新增 : <li class="active" machineId="{{ $machineId }}" categoryId="">
                    分类名称: <input type="text" name="name" value="" ><br/><br/>
                    排序(降序): <input type="text" name="sort" value="" ><br/>
                    <span>提交</span><br ><hr/>
                </li>
                编辑 :
                @foreach($category as $cate)
                    <li class="active" machineId="{{ $machineId }}" categoryId="{{ $cate->id }}">
                        分类ID:{{ $cate->id }}<br/>
                        分类名称: <input type="text" name="name" value="{{ $cate->name }}" ><br/>
                        排序(降序): <input type="text" name="sort" value="{{ $cate->sort }}" ><br/>
                        <span>提交</span>　||　<del>删除</del><br/><hr/>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>


<script>
    var page_class = 'category';
</script>
<script type="text/javascript" src="../h5/js/ttzd.js"></script>
<script type="text/javascript" src="../h5/js/helper.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_store.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_io.js"></script>
<script type="text/javascript" src="../h5/js/ttzd_page_category.js"></script>

</body>
</html>