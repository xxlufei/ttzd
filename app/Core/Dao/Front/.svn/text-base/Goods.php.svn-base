<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-25
 * Time: 22:31
 */

namespace App\Core\Dao\Front;

use App\Core\Enum\ExisitEnum;
use App\Core\Misc\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class Goods extends Model
{
    public $table = 'goods';
    public $primaryKey = "id";

    public static function createBiz($name, $categoryId, $price, $machineId, $imageUrl, $sort)
    {
        DB::insert('insert into goods set name=?, categoryid=?, price=?, machineid=?, imageurl=?, sort=?, stock=?, isdiscount=?, created_at=?', [$name, $categoryId, $price, $machineId, $imageUrl, $sort, 1000000, ExisitEnum::NO, Util::Now()]);
    }

    public static function getAllGoodsByMachineId($machineId)
    {
        $goods = DB::select("select id, name, description, imageurl, soldnum, price, discountprice, isdiscount, categoryid, stock, sort from goods where machineid=? and estate=? order by categoryid asc, sort desc", [$machineId, EstateEnum::VALID]);
        return $goods;
    }

    public static function checkStockByIdAndStockNum($id, $num)
    {
        $goods = DB::select("select * from goods where id=? and stock=?", [$id, $num]);
        return $goods;
    }

    public static function revertStock($obj)
    {
        $time = Util::Now();
        DB::update("update goods set stock=stock+{$obj->num}, updated_at='{$time}' where id={$obj->goodsid}");
    }
}