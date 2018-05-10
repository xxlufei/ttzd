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
                新增 : <li class="active" machineId="{{ $machineId }}" goodsId="">
                    商品名称: <textarea type="text" name="name" rows="5" cols="20"></textarea><br/>
                    分类id: <input type="text" name="categoryId" value="" ><br/>
                    价格: <input type="text" name="price" value="" ><br/>
                    排序(降序): <input type="text" name="sort" value="" ><br/>
                    图片: <div><input type="file" name="img" value=""></div><br/><br/>
                    <span>提交</span><br ><hr/>
                </li>
                编辑 :

                @foreach($goods as $g)
                    <li class="active" machineId="{{ $machineId }}" goodsId="{{ $g->id }}">
                        商品ID:{{ $g->id }}<br/>
                        商品名称: <textarea type="text" name="name" rows="5" cols="20">{{ $g->name }}</textarea><br/>
                        分类id: <input type="text" name="categoryId" value="{{ $g->categoryid }}" ><br/>
                        价格: <input type="text" name="price" value="{{ $g->price }}" ><br/>
                        排序(降序): <input type="text" name="sort" value="{{ $g->sort }}" ><br/>
                        图片(不上传表示不修改图片): <div><input type="file" name="img" value=""></div><br/><br/>
                        <span>提交</span>　||　<del>删除</del><br/><hr/>
                    </li>
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
<script type="text/javascript" src="../h5/js/ttzd_page_goods.js"></script>

</body>
</html>