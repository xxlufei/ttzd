<?php
namespace App\Core\Enum;


class WechatPushTemplateTypeEnum {
    use BaseEnum;

    const ORDER= 'Eomv031Y6qzVLTIJUvseCov7LTHCkfYI1imRXdW1G3g';


    private static $_defines = array(
        self::ORDER => '有人下单啦',
    );

    private static $_defineInts = array(
        self::ORDER => 1,
    );
}
?>
