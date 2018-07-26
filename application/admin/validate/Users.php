<?php

namespace app\admin\validate;

use think\Validate;

class Users extends Validate
{
    //验证器
    protected $rule=[
        ['name','require|min:5','昵称必须|昵称不能短于5个字符'],
        ['email','email','邮箱格式错误'], 
        
        //自定义规则
        ['email','checkMail:www.tp-shop.cn','邮箱格式错误'],
    ];
    
    //自定义规则
    //$value 
    //$rule  规则
    protected function checkMail($value,$rule){
        $result = strstr($value,$rule);
        if($result){
            return true;
        }else{
            return "邮箱必须包含$rule域名";
        }
    }

}

