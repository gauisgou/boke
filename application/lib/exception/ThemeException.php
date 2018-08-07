<?php

namespace app\lib\exception;

class ThemeException extends BaseException
{
    public  $code = 404;
    public  $msg = '自定的主题不存在，请检查指定的ID';
    public $errorCode = '30000';
    
}
