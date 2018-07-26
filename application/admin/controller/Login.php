<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use app\admin\model;
use org\util\VerificationCode;

class Login extends Controller
{

    public function index(){
        return $this->fetch('login');
    }
    //登陆
    public function login(){
        $input = input('post.');
        if($input['name'] != '' && $input['pwd'] != ''){
//            $data = Db::table('user')->select();
            $data = db::table('user')->where("user_name = '".$input['name']."' and password = '".md5($input['pwd'])."'")->select();
            if($data){
                session_start();
//                unset($_SESSION);
//                session_destroy();
                $data[0]['expiretime'] = time() + 3600;
                $_SESSION['user'] = $data['0'];
                return json(array('status' => 200,'msg' => '登陆成功'));
            }
        }else{
            return json(array('status' => 400,'msg' => '账号和密码不能为空'));
        }
        return json(array('status' => 400,'msg' => '账号或密码错误'));
    }
    
    //添加用户
    public function addUser(){
        $input = input('post.');
//        dump($input['name']);die;
        $input['name'] = 'root';
        $input['pwd'] = '123';
        if($input['name'] != '' && $input['pwd'] != ''){
            $user_arr['user_name'] = $input['name'];
            $user_arr['password'] = md5($input['pwd']);
            $user_arr['create_time'] = date('Y-m-d H:i:s',time());
//            db::execute("insert into `user` (`user_id`,`user_name`,`create_time`,`user_age`,`user_sex`,`password`) values (3,'12','2018-10-02 12:10:10','1',2,'12')
//");
//            db::execute("insert into `user` (`user_name`,`create_time`,`password`) values(?,?,?)",['wew',$user,'qwe']);
            $user = new model\user;
            $data = $user->allowField(true)->save($user_arr);
//            dump(db::getlastsql());die;
            if($data){
                return json(array('status'=>200,'msg'=>'添加新用户成功'));
            }
        }else{
            return json(array('status'=>400,'msg'=>'账号和密码不能为空'));
        }
        return json(array('status'=>400,'msg'=>'添加新用户失败'));
    }
    
    public function test(){
        //$_GET[]/$_POST[];
        print_r($this->request->param());
    }
}
