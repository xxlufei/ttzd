<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-04
 * Time: 14:59
 */

namespace App\Core\Enum;


class ErrorCodeEnum
{
    use BaseEnum;
    const SUCCESS = 200;
    const ERROR = ['status'=>4000, 'msg'=>'抱歉!库存不足，工作人员会尽快补充'];
    const ORDERINFOERROR = ['status'=>4001, 'msg'=>'订单信息错误'];
    const ORDERINGERROR = ['status'=>4002, 'msg'=>'您有未完成的订单'];
    const ORDERPAYERROR = ['status'=>4003, 'msg'=>'请勿重复支付订单'];
    const ORDERTIMEOUT = ['status'=>4005, 'msg'=>'您的订单已超时，请重新下单'];
    const ORDERREADYPAYFAILED = ['status'=>4004, 'msg'=>'生成支付信息失败，请稍后重试'];
    const NOWEIXINPAYORDER = ['status'=>4006, 'msg'=>'没有查询到相关支付信息，请稍后重试'];
    const FILETYPE = ['status'=>4007, 'msg'=>'文件类型不符'];
    const FILEUPFAILD = ['status'=>4008, 'msg'=>'文件上传失败'];
    const ARGERROR = ['status'=>4009, 'msg'=>'参数错误'];
    private static $_defines = array(
        self::SUCCESS => '成功',
        self::ERROR => '出现错误',

    );
}