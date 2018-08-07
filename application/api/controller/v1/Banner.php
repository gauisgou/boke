<?php

namespace app\api\controller\v1;
use think\Validate;
use app\api\controller\validate\TestValidate;
use app\api\controller\validate\IDMustBePostiveInt;
//引入异常
use think\Exception;
use app\lib\exception\BannerMissException;

use app\api\model\Banner as BannerModel;
class Banner
{
    /*
     * 获取指定id的banner信息
     * @url /banner/:id
     * @http GET
     * @id banner的id号
     * 独立验证 + 验证器
     */
    public function getBanner($id){      
/************************ 构建校验层(重要) ************************/
       //AOP  面向切面编程
        $e = (new IDMustBePostiveInt())->goCheck();
//        dump($e);
        echo 3;die;
/************************ 自定义方法-判断参数是否为正整数 ************************/
//        $data = [
//            'id' => '0.1',
//        ];
//        $validate = new IDMustBePostiveInt();
//        $result = $validate->batch()->check($data);
//        dump($result);
//        die; 
        
        $data = [
            'name' => 'validate',
            'email' => 'validate@qq.com'
        ];
/******************************** 方法一 ********************************/
//        $validate = new Validate([
//            'name' => 'require|max:10',
//            'email' => 'email'
//        ]);
//        $result = $validate->batch()->check($data);
/******************************** 方法二 ********************************/
        $validate = new TestValidate();
        $result = $validate->batch()->check($data);
        
        dump($validate->getError());
        dump($result);
        echo 34;die;
    }
    /*  
     * 获取自定异常信息处理
     * @http GET
     * @id banner的id号
     * 
     * 处理异常方法一 try{}catch(){}  不推荐，太繁琐
     * 
     */
   public function getBannerTest($id){
       (new IDMustBePostiveInt())->goCheck();
       try{
           $banner = BannerModel::getBannerByID($id);
       } catch (Exception $ex) {
           $arr = [
               'error_code' => 1001,
               'msg' => $ex->getMessage(),
           ];
           
           return json($arr,400);
       }
       return($banner);
   }
   /*  
     * 获取自定异常信息处理
     * @http GET
     * @id banner的id号
     * 
     * 处理异常方法二 创建exception文件夹处理 定义全局异常
     */
   public function getBannerTop($id){
       //AOP  面向切面编程
       (new IDMustBePostiveInt())->goCheck();
           $banner = BannerModel::getBannerByID($id);
       if(!$banner){
           throw new BannerMissException();
       }
       return($banner);
   }
   
   //数据库
   public function getBannerMysql($id){
       //AOP  面向切面编程
       (new IDMustBePostiveInt())->goCheck();
       
//           $banner = BannerModel::getBannerMysqlByID($id);
//      调用模型
//      $banner = new BannerModel();
//      $banner = $banner->get($id);
       //静态调用优于 > 对象调用
//        $banner = BannerModel::get($id);   
        //get,find,all,select
        /*
         * 多个关联查询 items items1
         */
        $banner = BannerModel::with(['items','items.img'])->find($id);
        //删除字段 delete_time
        //将模型获取到的数据转成可操作的数组array()
//        $data = $banner->toArray();
//        unset($data['delete_time']);
        //使用model方法隐藏 delete_time
//        $banner->hidden(['delete_time']);
        //使用model方法只显示 delete_time
//        $banner->visible(['delete_time']);
//        dump($data);die;
//        echo \think\Db::getlastsql();        
//           dump($banner);die;
       if(!$banner){
           throw new BannerMissException();
       }
//       $img = config('setting.img_prefix');
       return ($banner);
   }
}
