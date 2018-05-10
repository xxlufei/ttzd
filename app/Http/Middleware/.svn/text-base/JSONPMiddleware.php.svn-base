<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-04
 * Time: 14:06
 */

namespace App\Http\Middleware;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JSONPMiddleware
{
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        //不是jsonp请求,不作处理,放行
        if (!$request->isMethod('GET') || !$request->has('jsonp') || !$response instanceof JsonResponse) {
            return $next($request);
        }
        //处理后返回
        return $response->setCallback($request['jsonp']);
    }
}