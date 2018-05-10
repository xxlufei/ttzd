<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-12
 * Time: 11:08
 */

namespace App\Http\Controllers\Admin;


use App\Core\Dao\Front\Category;
use App\Core\Dao\Front\Goods;
use App\Core\Enum\ErrorCodeEnum;
use Illuminate\Http\Request;

class CategoryController
{
    public function cateList(Request $request)
    {
        $machineId = $request['machineId'];
        if (empty($machineId)) exit('数据错误');
        $category = Category::getAllCategoryByMachineId($machineId);
        return view('admin.category', ['category' => $category, 'machineId' => $machineId]);
    }

    public function submit(Request $request)
    {
        $name = $request['name'];
        $categoryId = $request['categoryId'];
        $machineId = $request['machineId'];
        $sort = intval($request['sort']);
        if (empty($name) || empty($machineId)) {
            return response()->json(ErrorCodeEnum::ARGERROR)->setCallback($request['jsonp']);
        }
        if (!empty($categoryId)) {
            $category = Category::getById($categoryId);
            if (empty($category))
                return response()->json(['status'=>4000, 'msg'=>'没有此分类'])->setCallback($request['jsonp']);
            $category->name = $name;
            $category->machineId = $machineId;
            $category->sort = $sort;
            $category->save();
        } else {
            Category::createBiz($name, $machineId, $sort);
        }
        return response()->json(['status'=>200, 'content'=>''])->setCallback($request['jsonp']);
    }
}