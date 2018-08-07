<?php

namespace app\api\model;

use think\Exception;
use think\Log;
use think\Db;
//引入数据库模型（model）
use think\Model;

class Banner extends Model
{
    //隐藏不需要查询的字段
    protected $hidden = ['id'];
    //关联模型
    public function items(){
        /*
         * 关联其他模型：一对多hasMany()，一对一belongsTo();
         * 第一个参数：要管理的模型名称
         * 第二个参数：关联表内的外键
         * 第三个参数：当前表的关联外键
         */
        return $this->hasMany('BannerItem','banner_id','id');
    }
    
    public function itemsi(){
        
    }
    //替换要查询到数据库表名
//    protected $table = 'comment';
    public static function getBannerByID($id){
//        echo 0.1;die;
//        根据banner ID号，获取banner信息
//        return 'this is banner info';
//        try {
//            1/0;
//        } catch (Exception $ex) {
//            //TODO:抛出异常/记录日志
//            Log::record($ex->getMessage(),'notice');
//            throw $ex;
////            echo $ex->getTraceAsString();
//        }
        return null;
//        return 'this is banner info';
    }
    public static function getBannerMysqlByID($id){
        //原生sql调用
//        $result = Db::query(
//                "select * from comment where id=?",[$id]
//                );
        //链式调用
//        $result = Db::table("comment")->where('id','=',$id)->select();
        //闭包调用
        
        $result = DB::table("comment")->
            where(function($query) use ($id){
            $query->where('id','=',$id);
            })->select();
        return $result;
//        echo db::getlastsql();
//        dump($result);die;
        //闭包调用
//        $result = DB:
    }
}

