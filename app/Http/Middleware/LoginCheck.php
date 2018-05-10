<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-30
 * Time: 19:40
 */

namespace App\Http\Middleware;


class LoginCheck
{
    public function handle($request, \Closure $next)
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
            exit('请从微信客户端打开本页面!');
        }
        if (empty(session('wechat_user'))) {
            exit('登录信息有误!');
        }
        return $next($request);

    }
}