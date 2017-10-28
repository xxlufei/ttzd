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
    public function index(Request $request){
        if (empty($request['machineId'])) {
            exit('error');
        }
        $categorys = Category::getAllCategoryByMachineId($request['machineId']);
        $goods = Goods::getAllGoodsByMachineId($request['machineId']);
        $machine = Machine::getById($request['machineId']);
        return view('h5.list',['goods'=>$goods, 'categorys'=>$categorys, 'machineName' => $machine->location]);
    }
}