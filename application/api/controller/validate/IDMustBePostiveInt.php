<?php

namespace app\api\controller\validate;

use think\Validate;

class IDMustBePostiveInt extends BaseValidate{
    //自定义方法-判断参数是否为正整数
    //isPositiveInteger 是一个自定义的方法
    protected $rule = [
        'id' => 'require|isPositiveInteger',
//        'num' => 'in:1,2,3'
    ];
    protected $message = [
        'id' => 'id必须是正整数',
    ];
    
}

