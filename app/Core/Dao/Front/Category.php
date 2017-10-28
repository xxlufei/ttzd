<?php
namespace App\Core\Dao\Front;

use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-25
 * Time: 22:26
 */
class Category
{
    public static function getAllCategoryByMachineId($machineId)
    {
        $categorys = DB::select("select id, name from category where machineid=? and estate=?", [$machineId, EstateEnum::VALID]);
        return $categorys;
    }
}