<?php

namespace app\api\controller\validate;

class TockeGet extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];
    protected $message = [
        'code' => '，没有code还行获取taocke，做梦哦！'
    ];
}

