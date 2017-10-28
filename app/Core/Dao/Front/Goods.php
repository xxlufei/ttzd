<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-25
 * Time: 22:31
 */

namespace App\Core\Dao\Front;

use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class Goods
{
    public static function getAllGoodsByMachineId($machineId)
    {
        $goods = DB::select("select id, name, description, imageurl, soldnum, price, discountprice, isdiscount from goods where machineid=? and estate=? order by categoryid asc", [$machineId, EstateEnum::VALID]);
        return $goods;
    }
}