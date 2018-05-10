<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-08
 * Time: 8:24
 */

namespace App\Http\Controllers\Admin;


use App\Core\Dao\Front\Category;
use App\Core\Dao\Front\Goods;
use App\Core\Dao\Front\Machine;
use App\Core\Enum\ErrorCodeEnum;
use App\Core\Enum\EstateEnum;
use config\EnvSetting;
use Illuminate\Http\Request;

class GoodsController
{
    public function glist(Request $request)
    {
        $machineId = $request['machineId'];
        if (empty($machineId)) exit('数据错误');
        $goods = Goods::getAllGoodsByMachineId($machineId);
        return view('admin.goods', ['goods' => $goods, 'machineId' => $machineId]);
    }

    public function goodsPicUp(Request $request)
    {
        $file = $_FILES['Filedata'];
        $name = $file['name'];
        $type = strtolower(substr($name,strrpos($name,'.')+1));
        $allow_type = array('jpg','jpeg','gif','png');
        if(!in_array($type, $allow_type)){
            return response()->json(ErrorCodeEnum::FILETYPE);
        }
        $upload_path = EnvSetting::$imagesDir;
        $upName = time() . '.' . $type;
        if(move_uploaded_file($file['tmp_name'], $upload_path . $upName)){
            return response(json_encode(['status'=>200, 'content'=>['path' => 'images/' . $upName]]));
        }else{
            return response(json_encode(ErrorCodeEnum::FILEUPFAILD));
        }
    }

    public function submit(Request $request)
    {
        $name = $request['name'];
        $categoryId = $request['categoryId'];
        $machineId = $request['machineId'];
        $price = $request['price'];
        $goodsId = $request['goodsId'];
        $imageUrl = $request['imageUrl'];
        $sort = intval($request['sort']);
        if (empty($name) || empty($categoryId) || empty($machineId) || empty($price)) {
            return response()->json(ErrorCodeEnum::ARGERROR)->setCallback($request['jsonp']);
        }
        if (!empty($goodsId)) {
            $goods = Goods::getById($goodsId);
            if (empty($goods))
                return response()->json(['status'=>4000, 'msg'=>'没有此商品'])->setCallback($request['jsonp']);
            $goods->name = $name;
            $goods->categoryId = $categoryId;
            $goods->machineId = $machineId;
            $goods->price = $price;
            $goods->sort = $sort;
            if (!empty($imageUrl)) {
                $goods->imageUrl = $imageUrl;
            }
            $goods->save();
        } else {
            Goods::createBiz($name, $categoryId, $price, $machineId, $imageUrl, $sort);
        }
        return response()->json(['status'=>200, 'content'=>''])->setCallback($request['jsonp']);
    }

    public function remove(Request $request)
    {
        $id = $request['id'];
        $type = $request['type'];
        switch ($type) {
            case 'goods' :
                $obj = Goods::getById($id);
            break;
            case 'category' :
                $obj = Category::getById($id);
            break;
            case 'machine' :
                $obj = Machine::getById($id);
            break;
        }
        if (!isset($obj)) return response()->json(ErrorCodeEnum::ARGERROR)->setCallback($request['jsonp']);
        $obj->estate = EstateEnum::DELETED;
        $obj->save();
        return response()->json(['status'=>200, 'content'=>''])->setCallback($request['jsonp']);
    }
}