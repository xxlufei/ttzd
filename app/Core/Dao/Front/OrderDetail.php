<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-04
 * Time: 20:05
 */

namespace App\Core\Dao\Front;

use App\Core\Misc\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class OrderDetail extends Model
{
    public $table = 'orderdetail';
    public $primaryKey = "id";
    public static function getOrderDetailByOrderId($orderId)
    {
        return self::where(['orderid'=>$orderId, 'estate'=>EstateEnum::VALID])->get();
    }
}