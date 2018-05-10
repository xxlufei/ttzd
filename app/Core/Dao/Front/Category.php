<?php
namespace App\Core\Dao\Front;

use App\Core\Misc\Util;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;
use Illuminate\Database\Eloquent\Model;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-25
 * Time: 22:26
 */
class Category extends Model
{
    public $table = 'category';
    public $primaryKey = "id";

    public static function createBiz($name, $machineId, $sort)
    {
        DB::insert('insert into category set name=?, machineid=?, sort=?, created_at=?', [$name, $machineId, $sort, Util::Now()]);
    }

    public static function getAllCategoryByMachineId($machineId)
    {
        $categorys = DB::select("select id, name, sort from category where machineid=? and estate=? order by sort desc", [$machineId, EstateEnum::VALID]);
        return $categorys;
    }
}