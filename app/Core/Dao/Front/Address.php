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

class Address extends Model
{
    public $table = 'address';
    public $primaryKey = "id";

    public static function createBiz($name, $address, $mobile, $userId)
    {
        DB::insert('insert into address set receiver=?, address=?, mobile=?, userId=?, created_at=?', [$name, $address, $mobile, $userId, Util::Now()]);
    }

    public static function getByUserId($userId)
    {
        return self::where(['userid' => $userId])->first();
    }
}