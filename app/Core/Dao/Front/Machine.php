<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-26
 * Time: 7:46
 */

namespace App\Core\Dao\Front;

use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class Machine
{
    public static function getById($machineId)
    {
        $machine = DB::select("select * from machine where id=? and estate=?", [$machineId, EstateEnum::VALID])[0];
        return $machine;
    }
}