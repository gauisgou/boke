<?php 
/*
 * model调用数据库访问层
 */
namespace app\api\service;
use think\Exception;
use app\lib\exception\WeChatException;
use app\lib\exception\TockeException;
use think\Cache;

class UserTocke extends Tocke
{
    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;
    
    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }
    //获取随机的32位字符
    
    
    public function get(){
        $key = 'uid';
        $value = $this->generateTocke(32);
        $expire_in = config('setting.tocke_expire_in');
        /*
         * 写入缓存,cache()方法是thinkphp5自带的写入缓存的方法
         * $expire_in  缓存时间
         */
//        $tocke = cache($key,$value,$expire_in);
//        dump(Cache::get('uid')); die;
        if(!$tocke){
            throw new TockeException([
                'msg' => '服务缓存异常',
                'errorCode' => 10005
            ]);
        }
        echo $tocke;die;
        
        
        
      
       $result = curl_get($this->wxLoginUrl);
       $wxResult = json_decode($result,true);
       if(empty($wxResult)){
           throw new Exception('获取ession_key及openIDh时异常，微信内部错误！');
       }else{
           //如果登陆又问题系统会返回一个errcode，如果登陆成功则不会
           $loginFail = array_key_exists('errcode', $wxResult);
           if($loginFail){
               $this->processLoginError($wxResult);
           }
           else{
               //颁发令牌
               $this->grantToken($wxResult);
           }
       }
//        return $code;
    }
    private function grantToken($wxResult){
        /*
         * 1。拿到openid，
         * 2。匹配数据库openid是否存在，不存在着新建一条用户数据
         * 3。生产令牌，准备缓存数据，写入令牌
         * 4。将令牌返回到客户端
         */
        dump($wxResult);die;
        $openid = $wxResult['openid'];
    }
    private function processLoginError($wxResult){
//        echo $wxResult['errmsg'];die;
           throw new WeChatException([
                'msg' => $wxResult['errmsg'],
                'errorCode' => $wxResult['errcode']
           ]);
    }
}
