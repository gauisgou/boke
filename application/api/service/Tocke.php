<?php

namespace app\api\service;

class Tocke
{
    public static function generateTocke($length = 32)
    {
        //获取32位随机字符串
        $randTocke = getRandChar($length);
        //当前脚本运行时间, 单位为十万分之一毫秒
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //盐（自定义字符串，加密用）
        $sale = config('secure.token_salt');
        //md5加密
        $dd = md5($randTocke.$timestamp.$sale);
        return $dd;
    }
}
