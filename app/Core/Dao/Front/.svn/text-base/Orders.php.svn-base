<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-04
 * Time: 17:27
 */

namespace App\Core\Dao\Front;

use App\Core\Enum\OrderStateEnum;
use App\Core\Misc\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class Orders extends Model
{
    public $table = 'orders';
    public $primaryKey = "id";
    public static function createBiz1($userId, $payprice, $goods, $priceArr, $nameArr, $stockArr, $mId)
    {
        $orderNo = self::makeOrderNo();
        $orderId = DB::table('orders')->insertGetId(['estate' => EstateEnum::VALID, 'orderno' => $orderNo,'userid'=>$userId, 'payprice'=>$payprice, 'orderstate'=>OrderStateEnum::INIT,  'machineid' => $mId, 'created_at'=>date('Y-m-d H:i:s')]);
        $sql = "INSERT INTO `orderdetail` (`estate`, `orderid`, `goodsid`, `goodsname`, `num`, `stock`, `goodsprice`, `created_at`) VALUES ";
        $vals = array();
        foreach ($goods as $gid => $num) {
            $sql .= '(?,?,?,?,?,?,?,?),';
            $vals[] = EstateEnum::VALID;
            $vals[] = $orderId;
            $vals[] = $gid;
            $vals[] = $nameArr[$gid];
            $vals[] = $num;
            $vals[] = $stockArr[$gid];
            $vals[] = $priceArr[$gid];
            $vals[] = Util::Now();
        }
        $sql = rtrim($sql, ',');
        DB::insert($sql, $vals);
        return ['orderId'=>$orderId, 'orderNo'=>$orderNo];
    }

    public static function getOrderByIdAndOrderNoAndUserId($id, $no, $userId)
    {
        return Orders::where(['id'=>$id, 'orderno'=>$no, 'userid'=>$userId, 'estate'=>EstateEnum::VALID])->first();
    }

    public static function getINGOrderByUserId($userId)
    {
        return Orders::where(['userid'=>$userId, 'estate'=>EstateEnum::VALID, 'orderstate'=>OrderStateEnum::INIT])->first();
    }

    public static function getOrderByOrderIdAndUserId($orderId, $userId)
    {
        return Orders::where(['userid'=>$userId, 'estate'=>EstateEnum::VALID, 'id'=>$orderId])->first();
    }

    public static function getAllInitOrder()
    {
        return Orders::where(['estate'=>EstateEnum::VALID, 'orderstate'=>OrderStateEnum::INIT])->get();
    }

    public static function getByOrderNo($orderNo)
    {
        return Orders::where(['estate'=>EstateEnum::VALID, 'orderno'=>$orderNo])->first();
    }

    public static function getAllPayOrder()
    {
        return Orders::where(['estate'=>EstateEnum::VALID, 'orderstate'=>OrderStateEnum::PAY])->orderBy('id','desc')->get();
    }

    public static function makeOrderNo()
    {
        $unique = uniqid('ttzd',true);
        $unique = explode('.', $unique)[1] . substr(time(), 6);
        return $unique;
    }


}