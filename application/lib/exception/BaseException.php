<?php

namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
    //HTTP 状态码 404 400 ...
    public $code = 400;
    
    //具体错误信息
    public $msg = '参数错误';
    
    //自定义的错误码
    public $errorCode = 10000;
}

