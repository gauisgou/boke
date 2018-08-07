<?php

namespace app\api\controller\validate;

use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{

    protected $rule = [
        'products' => 'checkProducts',
//        'product_id' => 'require|checkProducts',
//        'count' => 'require|isPositiveInteger'
    ];
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'count' => 'require|isPositiveInteger'
    ];
    
    public function checkProducts($value,$rule='',$data='',$field=''){
//        dump(90);die;
        if(!is_array($value)){
            throw new ParameterException([
                'msg' => '商品参数不正确'
            ]);
        }
        if(empty($value)){
            throw new ParameterException([
                'msg' => '商品列表不能为空',
            ]);
        }
        foreach ($value as $v)
        {
//            $d['product_id'] = 2;
            $this->heckProduct($v);
        }
        return true;
    }
    
    
    public function heckProduct($value){
        //手动调用验证器的方法
        $validata = new BaseValidate($this->singleRule);
        $result = $validata->check($value);
        if(!$result){
            throw new ParameterException([
                'msg' => '商品参数不正确111'
            ]);
        }
        return true;
//        dump($result);
    }
}
