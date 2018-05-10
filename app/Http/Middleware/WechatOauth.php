<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-29
 * Time: 20:34
 */

namespace App\Http\Middleware;


use App\Core\Dao\Front\User;
use config\EnvSetting;
use EasyWeChat\Foundation\Application;

class WechatOauth
{
    public function handle($request, \Closure $next)
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
            exit('请从微信客户端打开本页面!');
        }//var_dump(session('wechat_user'));exit;
        $user = session(EnvSetting::$userSessionKey);
        if (empty($user)) {
            //微信逻辑
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
                // 未登录
                $options = EnvSetting::$wechat;
                $options['oauth']['callback'] = $options['oauth']['callback'] . '?target_url=' . $request->getRequestUri();
                $wechat = new Application($options);
                $oauth = $wechat->oauth;
                return $oauth->redirect();
            }
        }
        $request['user'] = $user;
        return $next($request);

    }
}
