<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-26
 * Time: 7:46
 */

namespace App\Core\Dao\Front;

use App\Core\Misc\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class Machine extends Model
{
    public $table = 'machine';
    public $primaryKey = "id";
    public static function createBiz($location)
    {
        DB::insert('insert into machine set location=?, created_at=?', [$location, Util::Now()]);
    }

    /*public static function getById($machineId)
    {
        $machine = self::where(['estate'=>EstateEnum::VALID])->find($machineId);
        return $machine;
    }*/

    public static function getByOrderId($orderId)
    {
        $machine = DB::select("select m.location from machine m left join `orders` o on m.id = o.machineid where o.id=?  limit 1", [$orderId])[0];
        return $machine->location;
    }

    public static function getAll()
    {
        return $machine = DB::select("select * from machine where estate=?", [EstateEnum::VALID]);
    }
}