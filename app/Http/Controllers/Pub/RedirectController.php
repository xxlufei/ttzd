<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-04
 * Time: 22:56
 */

namespace App\Http\Controllers\Pub;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectToList(Request $request)
    {
        if (empty($request['m']))
            exit('请使用微信扫描二维码访问');

        return redirect("/goods_list?m={$request['m']}");
    }
}