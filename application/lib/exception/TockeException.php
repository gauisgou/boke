<?php

namespace app\lib\exception;

class TockeException extends BaseException
{
    public  $code = 401;
    public  $msg = 'tocke已过期，无效的tocke';
    public  $errorCode = '10001';
    
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

