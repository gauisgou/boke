<?php

namespace app\lib\exception;

use Exception;
use think\exception\Handle;
use think\Request;
use think\Log;
use app\lib\exception\BaseException;

class ExceptionHandlar extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    /*
     * 所有异常通过render方法渲染
     * 需要在config.php 配置下路径exception_handle
    */
    //需要返回客户端当前请求的URL路径
    public function render(\Exception $e)
    {
//        return json($e instanceof);
//        return json('~~~~~~~~~~~~~~~~~~~');
//        dump($e);
        if($e instanceof BaseException){
            //如果是自定义的异常(客户端异常)
//            return 231;
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
//            return www;
//            dump(config('app_debug'));die;
            if(config('app_debug') === true)
            {
                //生产模式 开启了app_debug
                return parent::render($e);
            }
            else
            {
                //正式上线 关闭了app_debug
                $this->code = 500;
                $this->msg = '服务器异常错误,不想告诉你';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
            
        }
        $request = Request::instance();
        $result = [
              'msg' => $this->msg,
              'error_code' => $this->errorCode,
              'requst_url' => $request->url(),
            ];
            return json($result,$this->code);
    }
    
    //记录日志
    public function recordErrorLog(\Exception $e){
        Log::init([
            'type'  => 'file',  //关闭日志test
            // 日志保存目录
            'path'  => LOG_PATH,
            // 日志记录级别
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(),'error');
        
    }
}

