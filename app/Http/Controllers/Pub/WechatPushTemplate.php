<?php
namespace App\Http\Controllers\Pub;


class WechatPushTemplate {
    public static $templateParams = array(
        'Eomv031Y6qzVLTIJUvseCov7LTHCkfYI1imRXdW1G3g' => array('name'),// 商品名称
    );

    public static function loadTemplate($openId, $tplId, $formatedParams, $first = '', $remark = '', $url = '')
    { /*{{{*/
        $data = array();
        if (is_array($first)) $first = implode("\n", $first);
        if (is_array($remark)) $remark = implode("\n", $remark);
        $data['first'] = array('value' => $first, 'color' => '#000');
        $data['remark'] = array('value' => $remark, 'color' => '#000');
        foreach (self::$templateParams[$tplId] as $paramName ) {
            $tmpParam = array_shift($formatedParams);
            $data[$paramName] = array('value' => $tmpParam, 'color' => '#000');
        }

        $msgArr['touser']      = $openId;
        $msgArr['template_id'] = $tplId;
        $msgArr['topcolor']    = '#FF7800';
        $msgArr['data']        = $data;
        if (!empty($url)) $msgArr['url'] = $url;

        return $msgArr;
    } /*}}}*/

    public function getTemplateParams($tplId)
    { /*{{{*/
        if (isset(self::$templateParams[$tplId])) 
            return self::$templateParams[$tplId];
        return array();
    } /*}}}*/
}
