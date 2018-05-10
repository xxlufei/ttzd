<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-08
 * Time: 8:11
 */

namespace App\Http\Middleware;


class AdminCheck
{
    public function handle($request, \Closure $next)
    {
        $openId = $request['user']['openid'];
        $adminUser = ['o3OvdwYEVwDOsSCtlrZGNZ_3USn4', 'o3OvdwbG_q5sMnb1jA_iDM5mTe1g'];
        if (!in_array($openId, $adminUser)) {
            exit('你没有权限!');
        }
        return $next($request);
    }
}