<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-28
 * Time: 23:16
 */
class EnvSetting
{
    public static $wechat = [
        'debug'  => true,
        'app_id' => 'wxf2574b28c7280b5a',
        'secret' => 'b2df9b6273bf6fc7fa647a6f16f1a03d',
        'token'  => 'easywechat',
        // 'aes_key' => null, // 可选
        'log' => [
            'level' => 'debug',
            'file'  => '/tmp/easywechat.log', // XXX: 绝对路径！！！！
        ],
        //...
    ];
}