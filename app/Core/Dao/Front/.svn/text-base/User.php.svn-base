<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-29
 * Time: 22:32
 */

namespace App\Core\Dao\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Core\Enum\EstateEnum;

class User extends Model
{
    public $table = 'user';
    public $primaryKey = "id";
    public static function getByUnionId($unionid)
    {
        $user = self::select('id')->where(['unionid'=>$unionid, 'estate'=>EstateEnum::VALID])->first();
        return $user;
        $user = DB::select("select * from user where openid=? and estate=?", [$openId, EstateEnum::VALID]);
        return $user;
    }

    public static function getAddress($userId)
    {
        $sql = 'select u.nickname, a.mobile, a.address, a.receiver from user left join address a on u.id = a.userid where u.id=?';
        return DB::select($sql, [$userId])[0];
    }
}
