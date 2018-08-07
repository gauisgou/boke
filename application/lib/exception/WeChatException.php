<?php 

namespace app\lib\exception;

class WeChatException extends BaseException
{
    public $code = 400;
    public $msg = '微信服务接口调用失败';
    public $errorCode = 900;
    
    public function __construct($params = []) {
        if(!is_array($params)){
//            return ;
            throw Exception('参数必须是数组');
        }
        if(array_key_exists('code', $params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg', $params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode', $params)){
            $this->errorCode = $params['errorCode'];
        }
    }
}

