<?php

namespace app\api\controller;

use think\Controller;
use think\Db;
use think\Log;
use think\Validate;
//拿入admin模块的的model文件使用
use app\admin\model\Users;

class TestModel extends Controller
{
    public function index()
    {
//        echo 00;die;
        $name = Users::get(1);
        //调用读取器 读取name字段
        echo $name ->name; 
        //调用修改器 修改name字段
        $name->name=444;
        $name->save();
        echo Db::getlastsql();
        //调用查询范围(scope('name') 自动转换成 scopeName 方法)
        $last = Users::scope('name')->all();
        die;
        print_r($name['name']);
    }
    
    //调用验证器
    public function add(){
        $data = input('post.');
        $result = $this->validate($data,'Users');
        if(true !== $result)
        {
            return $result;
        }
        $users = new Users;
        //保存数据
        $users->allowField(true)->save($data);
    }
    
    //单独验证某字段
    public function add1(){
        $data = input('post.');
        //验证birthday是否有效日期（调用validate的内置静态is方法）
        $check = Validate::is($data['birthday'],'date');
        if(false === $check){
            return 'birthday日期格式非法';
        }
        $users = new Users;
        //数据保存
        $users->allowField(true)->save($data);
    }
    //表单验证
    public function add2(){
        $users = new Users;
        if($users->allowField(true)->validate(true)->save('post.')){
            return true;
        }
        return $users->getError();
    }
    
    //日志记录
    public function log(){
        Log::error('错误日志');
        Log::info('普通日志信息');
        trace('写入普通日志','info');
        trace('写入错误日志','error');
        //日志会被记录在runtime/log/...
    }
}

