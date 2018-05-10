<?php
namespace App\Http\Controllers\Pub;
use App\Core\Dao\Front\User;
use App\Core\Misc\Util;
use App\Http\Controllers\Controller;
use config\EnvSetting;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-28
 * Time: 23:19
 */
class WechatController extends Controller
{
    public function index()
    {
        echo 'done';exit;
    }

    public function oauth_callback(Request $request)
    {
        $wechat = new Application(EnvSetting::$wechat);
        $oauth = $wechat->oauth;
        // 获取 OAuth 授权结果用户信息
        $wechatUser = $oauth->user()->toArray();
        $openid = $wechatUser['original']['openid'];
        $unionid = $wechatUser['original']['unionid'];
        //数据库中是否存在
        $exists = User::getByUnionId($unionid);
        $user = [
            'unionid' => $unionid,
            'openid' => $openid,
            'avatar' => $wechatUser['avatar'],
            'nickname' => $wechatUser['nickname'],
            'created_at' => Util::Now(),
        ];
        if (!$exists) {
            $user_id = User::insertGetId($user);
        } else {
            $user_id = $exists->id;
        }
        $user['id'] = $user_id;
        session(['wechat_user' => $user]);
        return redirect($request['target_url']);
    }

    public static function pushMsg($notice, $openId, $templateId, $data, $url)
    {
        /*$app = new Application(EnvSetting::$wechat);
        $notice = $app->notice;*/
        /*$msgArr = WechatPushGen::orderMsgGen($openId);//var_dump($msgArr);exit;
        $result = $notice->send($msgArr);
        var_dump($result);*/
        $result = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($openId)->send();
    }

}
