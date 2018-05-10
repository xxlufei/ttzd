<?php
namespace App\Http\Controllers\H5;

use App\Core\Dao\Front\Category;
use App\Core\Dao\Front\Goods;
use App\Core\Dao\Front\Machine;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-24
 * Time: 22:53
 */
class IndexController extends Controller
{
    public function pay(){
        return view('h5.pay');
    }

    public function index(Request $request)
    {
        if (empty($request['machineId'])) {
            exit('请扫码打开本页面');
        }
        $categorys = Category::getAllCategoryByMachineId($request['machineId']);
        $goods = Goods::getAllGoodsByMachineId($request['machineId']);
        $firstCategoryId = $goods[0]->categoryid;
        return view('h5.list', ['goods' => $goods, 'categorys' => $categorys, 'firstCategoryId' => $firstCategoryId]);
    }
}