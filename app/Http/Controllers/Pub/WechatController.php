<?php
namespace App\Http\Controllers\Pub;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-28
 * Time: 23:19
 */
class WechatController extends Controller
{
    public function index()
    {echo 5;exit;
        $options = [
            'debug'  => true,
            'app_id' => 'your-app-id',
            'secret' => 'you-secret',
            'token'  => 'easywechat',
            // 'aes_key' => null, // 可选
            'log' => [
                'level' => 'debug',
                'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
            ],
            //...
        ];

    }
}