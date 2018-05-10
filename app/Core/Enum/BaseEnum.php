<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-10-25
 * Time: 22:37
 */

namespace App\Core\Enum;


trait BaseEnum
{
    public static function isEnum($value)
    {/*{{{*/
        if (isset(self::$_defines[$value]))
            return true;

        return false;
    }/*}}}*/

    public static function isEnumByChinese($value)
    {/*{{{*/
        if (array_search($value, self::$_defines))
            return true;

        return false;
    }/*}}}*/

    public static function Defines()
    {/*{{{*/
        return self::$_defines;
    }/*}}}*/

    public static function valueOf($value, $default="")
    {/*{{{*/
        if (self::isEnum($value))
            return $value;

        return $default;
    }/*}}}*/

    public static function nameOf($value, $default="")
    {/*{{{*/
        if (self::isEnum($value))
            return self::$_defines[$value];

        return $default;
    }/*}}}*/

    public static function intOf($value, $default=0)
    {/*{{{*/
        if (self::isEnum($value))
            return self::$_defineInts[$value];

        return $default;
    }/*}}}*/

    public static function valueFromInt($int)
    {/*{{{*/
        if (($value = array_search($int, self::$_defineInts)) !== false)
            return $value;

        return null;
    }/*}}}*/

    public static function getByChinese($value)
    {/*{{{*/
        if ($code = array_search($value, self::$_defines))
            return $code;

        return '';
    }/*}}}*/
}