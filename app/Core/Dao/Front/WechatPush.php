<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-05
 * Time: 18:32
 */

namespace App\Core\Dao\Front;

use App\Core\Enum\ExisitEnum;
use App\Core\Enum\OrderStateEnum;
use App\Core\Misc\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class WechatPush extends Model
{
    public $table = 'wechatpush';
    public $primaryKey = "id";

    public static function createBiz($orderId)
    {
        DB::insert('insert ignore into wechatpush set orderid=?, created_at=?, state=?', [$orderId, Util::Now(), ExisitEnum::NO]);
    }

    public static function getReadyPushData()
    {
        return self::where(['state'=>ExisitEnum::NO])->orderBy('id')->get();
    }
}