<?php

namespace app\api\controller\validate;

use think\Validate;
use think\Request;
use app\lib\exception\ParameterException;

class BaseValidate extends Validate
{
    public function goCheck(){
        //获取http所以参数
        //对参数作校验
        $request = Request::instance();
        $params = $request->param();
//        dump($params);die;
//        $params = $params['count'];
//        dump($params);die;
        $result = $this->batch()->check($params);
        if(!$result){

            /************** 自定义错误异常 (一)**************/
            $e = new ParameterException([
                'msg' => $this->error,
//                'code' => 400,
//                'errorCode' => 10002
            ]);
            throw $e;
            /************** 自定义错误异常 (二)**************/
//            $e = new ParameterException();
//            $e->msg = $this->error;
//            $e->errorCode = 10002;
//            throw $e;
            
            //thinkphp5系统错误异常
            //$error = $this->error;
//            throw new Exception($error);
        }
        else{
//            echo true;
            return true;
        }
    }
    //验证参数是正整数
    protected function isPositiveInteger($value,$rule='',$data='',$field=''){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0)>0){
            return true;   
        }else{
//            echo '参数必须是正整数';
            return false;
//            return $field.'必须是正整数';
        }
    }
    //验证参数不为空
    protected function isNotEmpty($value,$rule='',$data='',$field=''){
        if(empty($value)){
            return $field.'不允许为空';
            return false;
        }else{
            return true;
        }
    }
    
}

