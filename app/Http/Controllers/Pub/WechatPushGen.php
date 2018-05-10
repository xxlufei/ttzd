<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-11-05
 * Time: 17:13
 */

namespace App\Http\Controllers\Pub;


use App\Core\Enum\WechatPushTemplateTypeEnum;

class WechatPushGen
{
    public static function orderMsgGen($openId)
    { /*{{{*/
        $formatedParams = array();
        $formatedParams[] = '商旅代订';
        $first = "您好，我们已为您完成房源选择，请确认相关信息后我们将为您进行房源预订。\n";
        $remark = array();
        $remark[] = "房源标题：大别墅";
        $remark[] = "支付金额：￥111";
        $msgArr = WechatPushTemplate::loadTemplate($openId, WechatPushTemplateTypeEnum::ORDER, $formatedParams, $first, $remark, 'http://www.baidu.com');
        return $msgArr;
    } /*}}}*/
}