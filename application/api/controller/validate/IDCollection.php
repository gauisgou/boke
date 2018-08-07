<?php

namespace app\api\controller\validate;

class IDCollection extends BaseValidate
{
    protected $rule = [
        'id' => 'require|checkIDs',
    ];
    protected $message = [
        'id' => 'ids必须是以逗号分隔的多个正整数',
    ];
    protected function checkIDs($value,$rule='',$data='',$field=''){
        $value = explode(',', $value);
        if(empty($value)){
            return false;
        }
        foreach($value as $v){
            if(!$this->isPositiveInteger($v)){
                return false;
            }
        }
        return true;
    }
}

